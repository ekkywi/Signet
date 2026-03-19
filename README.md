# Signet Licensing Platform 🛡️

**Bulletproof, API-first software licensing engine engineered from the silicon up.**

Signet is a high-performance licensing backend built to protect digital assets from piracy without the exorbitant costs of traditional enterprise security providers. It features dynamic API licenses, strict node-locked hardware binding, and a proprietary Micro Hardware Security Module (HSM) architecture for zero-knowledge cryptographic signing.

Engineered by Trezanix.

---

## ✨ Core Features

- **Node-Locked Binding:** Tie licenses permanently to a specific user's Machine ID (MAC Address, CPU Serial, or UUID).
- **Floating Licenses (Seat-Based):** Seamlessly scale B2B deployments with concurrent session tracking and max activation limits.
- **Hardware-Backed Cryptography (HSM):** Signatures are calculated inside physically isolated silicon chips using ECDSA (secp256r1). Private keys never touch the internet or the database.
- **Frictionless Developer API:** Universal REST API endpoints (`/validate`, `/deactivate`) that integrate into C++, Rust, C#, Node.js, or Python applications in minutes.
- **Enterprise Dashboard:** Real-time metrics, device revocation management, and built-in interactive developer documentation.

## 📚 Documentation

- **Public Overview:** Visit `/help` for architecture details and security models.
- **Developer API:** Authenticated users can access the technical API reference at `/docs` from the console sidebar.

## 🔒 Security & HSM Integration

_Note: The web application acts as a secure courier. For production deployment, ensure the Signet backend is correctly bridged via USB/Serial to the Trezanix Micro HSM cluster to handle payload signing._

---

**Author:** Yon Ekky Wijayanto
**Copyright &copy; 2026 Trezanix. All rights reserved.**
