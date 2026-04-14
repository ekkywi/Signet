import http from "http";

// ==========================================
// ⚙️ KONFIGURASI SIMULATOR HSM (PASTIKAN 3 BARIS INI ADA)
// ==========================================
const SERVER_URL = "http://127.0.0.1:8888/api/internal/hsm/ping";
const BEARER_TOKEN = "sk_hsm_FyMj7UnLiujFXAklvPKJfrnUFaZ4ZHcpk5h6OEkw";
const PING_INTERVAL = 5000;

console.log("=====================================");
console.log("🟢 HSM Node Simulator (ESP32 Mock) 🟢");
console.log("=====================================\n");
console.log(`Start heartbeat to: ${SERVER_URL}`);

function sendHeartbeat() {
  const currentTemp = (Math.random() * (45 - 40) + 40).toFixed(1);
  const payload = JSON.stringify({ temperature: parseFloat(currentTemp) });

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${BEARER_TOKEN}`,
      "Content-Length": Buffer.byteLength(payload),
    },
  };

  const req = http.request(SERVER_URL, options, (res) => {
    let data = "";
    res.on("data", (chunk) => {
      data += chunk;
    });

    res.on("end", () => {
      if (res.statusCode === 200) {
        const responseJson = JSON.parse(data);
        console.log(
          `[${new Date().toLocaleTimeString()}] PONG! Temperature: ${currentTemp}°C`,
        );

        if (responseJson.action) {
          console.log(
            `\n⚡ COMMAND RECEIVED: [ ${responseJson.action.toUpperCase()} ] ⚡`,
          );

          if (responseJson.action === "restart") {
            console.log("⏳ Stopping cryptographic services...");
            console.log("⏳ Restarting ESP32 System...\n");
          } else if (responseJson.action === "power_off") {
            console.log("🔴 Powering off device. Simulator stopped.");
            process.exit(0);
          } else if (responseJson.action === "sign_check") {
            console.log("🔍 Running Encryption Self-Test... [OK]\n");
          } else if (responseJson.action === "ping_test") {
            console.log("🔔 Ping from Admin received!\n");
          }
        }
      } else {
        console.error(
          `❌ Ping failed! HTTP Status: ${res.statusCode} - Data: ${data}`,
        );
      }
    });
  });

  req.on("error", (e) => {
    console.error(`❌ Gagal koneksi ke Laravel: ${e.message}`);
  });

  req.write(payload);
  req.end();
}

sendHeartbeat();
setInterval(sendHeartbeat, PING_INTERVAL);
