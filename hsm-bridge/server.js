const express = require("express");
const { SerialPort } = require("serialport");
const { ReadlineParser } = require("@serialport/parser-readline");

const app = express();
app.use(express.json());

const PORT_PATH = process.env.SERIAL_PORT || "/dev/ttyUSB0";
const BAUD_RATE = 115200;
const HTTP_PORT = 3000;

let port, parser;
let isPortOpen = false;

const taskQueue = [];
let isProcessing = false;

function initSerial() {
    port = new SerialPort({ path: PORT_PATH, baudRate: BAUD_RATE }, (err) => {
        if (err) {
            console.error("[HSM ERROR]", err.message);
            isPortOpen = false;
            setTimeout(initSerial, 5000);
            return;
        }
        console.log(`[HSM SECURE] Connected to Micro HSM on ${PORT_PATH}`);
        isPortOpen = true;
    });

    parser = port.pipe(new ReadlineParser({ delimiter: "\n" }));

    parser.on("data", (data) => {
        const rawResponse = data.trim();
        console.log(`[ESP32 SAYS] ${rawResponse}`);

        if (taskQueue.length > 0 && isProcessing) {
            const currentTask = taskQueue[0];
            clearTimeout(currentTask.timeoutTimer);

            try {
                const parsedResponse = JSON.parse(rawResponse);
                currentTask.resolve(parsedResponse);
            } catch (e) {
                currentTask.reject({
                    status: "error",
                    message: "Invalid JSON from HSM",
                    raw: rawResponse,
                });
            }

            taskQueue.shift();
            isProcessing = false;
            processNextTask();
        }
    });

    port.on("close", () => {
        console.log(`[HSM WARNING] Connection lost. Reconnecting...`);
        isPortOpen = false;
        setTimeout(initSerial, 5000);
    });
}

function processNextTask() {
    if (taskQueue.length === 0 || isProcessing || !isPortOpen) return;

    isProcessing = true;
    const currentTask = taskQueue[0];

    currentTask.timeoutTimer = setTimeout(() => {
        console.error("[HSM TIMEOUT] ESP32 did not respond within 15 seconds!");
        currentTask.reject({
            status: "error",
            message: "HSM Hardware Timeout (Key Generation took too long)",
        });
        taskQueue.shift();
        isProcessing = false;
        processNextTask();
    }, 15000);

    console.log(`[HSM SEND] Sending payload...`);
    port.write(JSON.stringify(currentTask.payload) + "\n", (err) => {
        if (err) {
            clearTimeout(currentTask.timeoutTimer);
            currentTask.reject({
                status: "error",
                message: "Failed to write to Serial Port",
            });
            taskQueue.shift();
            isProcessing = false;
            processNextTask();
        }
    });
}

app.get("/api/hsm/status", (req, res) => {
    if (!isPortOpen) return res.status(503).json({ status: "offline" });
    new Promise((resolve, reject) => {
        taskQueue.push({ payload: { action: "ping" }, resolve, reject });
        processNextTask();
    })
        .then((r) => res.json(r))
        .catch((e) => res.status(500).json(e));
});

app.post("/api/hsm/generate-identity", (req, res) => {
    if (!isPortOpen) return res.status(503).json({ status: "offline" });
    new Promise((resolve, reject) => {
        taskQueue.push({
            payload: { action: "generate_identity", data: req.body.data },
            resolve,
            reject,
        });
        processNextTask();
    })
        .then((r) => res.json(r))
        .catch((e) => res.status(500).json(e));
});

app.listen(HTTP_PORT, "0.0.0.0", () => {
    console.log(
        `[BRIDGE READY] HSM Bridge Daemon listening on port ${HTTP_PORT}`,
    );
    initSerial();
});
