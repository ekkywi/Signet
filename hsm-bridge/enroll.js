const fs = require("fs");
const axios = require("axios");
const API_BASE_URL = "http://host.docker.internal:8000";
const token = process.argv[2];

if (!token) {
  console.error("Error: Missing token. Usage: node enroll.js <token>");
  process.exit(1);
}

async function enrollNode() {
  console.log("Enrolling node with token: ${token}");

  try {
    const response = await axios.post(`${API_BASE_URL}/api/hsm/enroll`, {
      token: token,
    });

    const secretKey = response.data.secret_key;
    const nodeName = response.data.node_name;
    const envContent = `HSM_NODE_NAME=${secretKey}\nHSM_NODE_NAME=${nodeName}\nAPI_BASE_URL=${API_BASE_URL}\n`;
    fs.writeFileSync(".env", envContent);

    console.log(`Success! Node [${nodeName}] enrolled successfully.`);
    console.log(`.env file created automatically.`);
    console.log(
      `Please restart the container to apply changes: docker restart signet-hsm`,
    );
  } catch (error) {
    if (error.response) {
      console.error(`Enrollment failed" ${error.response.data.message}`);
    } else {
      console.error(
        `Connection failed. Is the API server running at ${API_BASE_URL}?`,
      );
    }
  }
}

enrollNode();
