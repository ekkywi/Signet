<x-layouts.app title="Dev Documentation - Signet">

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-20">
        <div class="max-w-7xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">Developer Documentation</h2>
            <p class="text-sm text-gray-500 mt-1">Integrate Signet's licensing engine into your client applications.</p>
        </div>
    </div>

    <div class="p-8 max-w-7xl mx-auto w-full">
        <div class="flex flex-col md:flex-row gap-10">

            <div class="w-full md:w-64 flex-shrink-0">
                <div class="sticky top-40 space-y-8">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Getting Started</h4>
                        <ul class="space-y-2">
                            <li><a class="text-sm text-gray-400 hover:text-teal-400 transition-colors" href="#authentication">Authentication</a></li>
                            <li><a class="text-sm text-gray-400 hover:text-teal-400 transition-colors" href="#hardware-lock">Hardware Locking</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Integrations</h4>
                        <ul class="space-y-2">
                            <li><a class="text-sm text-teal-500 font-medium hover:text-teal-400 transition-colors flex items-center gap-2" href="#python-sdk">
                                    Python SDK
                                    <span class="bg-teal-500/20 text-teal-400 text-[10px] px-1.5 py-0.5 rounded uppercase font-bold tracking-widest">Recommended</span>
                                </a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Raw API Endpoints</h4>
                        <ul class="space-y-2">
                            <li><a class="text-sm text-gray-400 hover:text-teal-400 transition-colors" href="#validate-license">Validate License</a></li>
                            <li><a class="text-sm text-gray-400 hover:text-teal-400 transition-colors" href="#deactivate-license">Deactivate License</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex-1 space-y-12 pb-20">

                <section class="scroll-mt-40" id="authentication">
                    <h3 class="text-xl font-bold text-white mb-4">Authentication</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        All API requests to Signet must be authenticated using an API Key. You can generate API Keys from your dashboard. Include the key in the header of your HTTP requests.
                    </p>
                    <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden">
                        <div class="bg-[#0a0a0a] px-4 py-2 border-b border-gray-800">
                            <span class="text-xs font-medium text-gray-500">HTTP Header</span>
                        </div>
                        <div class="p-4 overflow-x-auto">
                            <code class="text-sm font-mono text-teal-400">x-api-key: sgnt_live_your_secret_api_key_here</code>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-800">

                <section class="scroll-mt-40" id="hardware-lock">
                    <h3 class="text-xl font-bold text-white mb-4">Hardware Locking (Node-Locked)</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        Signet uses a robust device management system. If a license is configured to require a hardware lock, your client application must provide a unique, immutable <code class="text-teal-400 font-mono text-xs">hardware_id</code> (such as a Motherboard MAC Address, CPU Serial, or App UUID).
                    </p>
                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-5 mt-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <div>
                                <h5 class="text-sm font-semibold text-blue-400 mb-1">Important Implementation Note</h5>
                                <p class="text-xs text-blue-300 leading-relaxed">
                                    The <code class="font-mono bg-blue-900/50 px-1 rounded">hardware_id</code> is used to count "Activation Slots". If a license allows 3 Max Devices, the first 3 unique hardware IDs will be registered. Any 4th device attempting to validate the same key will be rejected until one of the existing devices is deactivated.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-800">

                <section class="scroll-mt-40" id="python-sdk">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-teal-500/10 text-teal-400 px-2.5 py-1 rounded text-xs font-bold tracking-wide border border-teal-500/20">RECOMMENDED</span>
                        <h3 class="text-xl font-bold text-white">Official Python SDK</h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        If you are building a Python application, we highly recommend using our official SDK. It automatically handles hardware ID generation, HTTP requests, and the complex offline Zero-Trust ECDSA cryptographic verification.
                    </p>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">1. Installation</h4>
                                <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden relative group">
                                    <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>pip install git+https://github.com/trezanix/signet-python-sdk.git</code></pre>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">2. Quick Implementation</h4>
                                <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden relative group">
                                    <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code><span class="text-purple-400">from</span> signet <span class="text-purple-400">import</span> SignetClient

<span class="text-gray-500"># 1. Initialize the client securely</span>
client = SignetClient(
    api_url=<span class="text-green-400">"https://your-domain.com"</span>,
    api_key=<span class="text-green-400">"sgnt_live_your_api_key"</span>,
    public_key_pem=<span class="text-green-400">"-----BEGIN PUBLIC KEY-----\n..."</span>
)

<span class="text-gray-500"># 2. Check local offline license first (Zero-Trust)</span>
is_valid = client.verify_local_license(cert_path=<span class="text-green-400">"license.cert"</span>)

<span class="text-purple-400">if not</span> is_valid:
    <span class="text-gray-500"># 3. If offline fails, activate online</span>
    result = client.activate_license(
        license_key=<span class="text-green-400">"USER-SERIAL-KEY"</span>,
        product_slug=<span class="text-green-400">"your-product-slug"</span>,
        save_path=<span class="text-green-400">"license.cert"</span>
    )
    <span class="text-purple-400">if</span> result[<span class="text-green-400">"success"</span>]:
        <span class="text-blue-400">print</span>(<span class="text-green-400">"Activated successfully!"</span>)</code></pre>
                                </div>
                                <div class="mt-4">
                                    <a class="text-sm text-teal-400 hover:text-teal-300 transition-colors inline-flex items-center gap-1" href="https://github.com/trezanix/signet-python-sdk" target="_blank">
                                        View full production-ready examples on GitHub
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-800">

                <section class="scroll-mt-40" id="validate-license">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded text-xs font-bold tracking-wide border border-blue-500/20">POST</span>
                        <h3 class="text-xl font-bold text-white">Raw API: Validate License</h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Verifies a license key, checks its expiration, and registers the client's hardware ID to consume an activation slot. Use this only if you are building an integration in a language other than Python.
                    </p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">Endpoint Structure</h4>
                                <code class="block w-full bg-[#111] border border-gray-800 rounded-lg p-3 text-sm font-mono text-gray-300">
                                    /api/v1/licenses/validate
                                </code>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">Parameters</h4>
                                <ul class="space-y-2 mb-4 bg-[#111] border border-gray-800 rounded-xl p-4">
                                    <li class="text-sm text-gray-400"><code class="text-teal-400 font-mono text-xs">license_key</code> <span class="text-red-400 text-xs ml-1">(Required)</span><br><span class="text-xs text-gray-500">The license string input by the user.</span></li>
                                    <li class="text-sm text-gray-400"><code class="text-teal-400 font-mono text-xs">product_slug</code> <span class="text-red-400 text-xs ml-1">(Required)</span><br><span class="text-xs text-gray-500">Your product's unique identifier.</span></li>
                                    <li class="text-sm text-gray-400"><code class="text-teal-400 font-mono text-xs">hardware_id</code> <span class="text-red-400 text-xs ml-1">(Required)</span><br><span class="text-xs text-gray-500">Unique device fingerprint (MAC/UUID).</span></li>
                                    <li class="text-sm text-gray-400"><code class="text-teal-400 font-mono text-xs">device_name</code> <span class="text-gray-500 text-xs ml-1">(Optional)</span><br><span class="text-xs text-gray-500">Human-readable name for the dashboard.</span></li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">Request Body (JSON)</h4>
                                <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden relative group">
                                    <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"license_key"</span>: <span class="text-green-400">"BWEAL-E8VUG-GDYHY-ZFZBM-YZAFZ"</span>,
  <span class="text-blue-400">"product_slug"</span>: <span class="text-green-400">"awesome-app-xVt91"</span>,
  <span class="text-blue-400">"hardware_id"</span>: <span class="text-green-400">"00:1A:2B:3C:4D:5E"</span>,
  <span class="text-blue-400">"device_name"</span>: <span class="text-green-400">"OFFICE-PC-1"</span>
}</code></pre>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">Success Response (200 OK)</h4>
                                <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden">
                                    <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"status"</span>: <span class="text-green-400">"success"</span>,
  <span class="text-blue-400">"message"</span>: <span class="text-green-400">"License is valid and cryptographically signed."</span>,
  <span class="text-blue-400">"data"</span>: {
    <span class="text-blue-400">"product"</span>: <span class="text-green-400">"Awesome App"</span>,
    <span class="text-blue-400">"type"</span>: <span class="text-green-400">"node-locked"</span>,
    <span class="text-blue-400">"expires_at"</span>: <span class="text-green-400">"2026-03-24T00:00:00+00:00"</span>,
    <span class="text-blue-400">"signed_payload"</span>: {
      <span class="text-blue-400">"license_key"</span>: <span class="text-green-400">"BWEAL-E8VUG-GDYHY-ZFZBM-YZAFZ"</span>,
      <span class="text-blue-400">"hardware_id"</span>: <span class="text-green-400">"00:1A:2B:3C:4D:5E"</span>,
      <span class="text-blue-400">"product"</span>: <span class="text-green-400">"awesome-app-xVt91"</span>,
      <span class="text-blue-400">"expires_at"</span>: <span class="text-green-400">"2026-03-24T00:00:00+00:00"</span>,
      <span class="text-blue-400">"timestamp"</span>: <span class="text-orange-400">1774273862</span>
    }
  },
  <span class="text-blue-400">"signature"</span>: <span class="text-green-400">"MEUCID+kF1dSHlYQbyYR6GkoJG6NjHDPjETjrtCWX2K5dNQmAiEAh/QrWdffkP0JoqhwhIp+EhL62jMIaSkOwBi++OUSBAs="</span>
}</code></pre>
                                </div>
                            </div>

                            <div class="bg-teal-500/10 border border-teal-500/20 rounded-xl p-5">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-teal-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                    <div>
                                        <h5 class="text-sm font-semibold text-teal-400 mb-1">Crucial Security Step: Verify the Signature</h5>
                                        <p class="text-xs text-teal-300/80 leading-relaxed">
                                            Do not just check for a <code class="font-mono bg-teal-900/50 px-1 rounded">200 OK</code> status. To prevent server-spoofing, your application must stringify the <code class="font-mono bg-teal-900/50 px-1 rounded">signed_payload</code> object and verify it against the Base64 <code class="font-mono bg-teal-900/50 px-1 rounded">signature</code> using Signet's ECDSA Public Key embedded in your app.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">Common Error Responses</h4>
                                <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden">
                                    <table class="w-full text-left text-sm text-gray-400">
                                        <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs text-gray-500">
                                            <tr>
                                                <th class="px-4 py-3">HTTP Status</th>
                                                <th class="px-4 py-3">Cause / Message</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-800">
                                            <tr>
                                                <td class="px-4 py-3 font-mono text-red-400">403 Forbidden</td>
                                                <td class="px-4 py-3 text-xs">Activation limit reached or license has expired/revoked.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 font-mono text-orange-400">404 Not Found</td>
                                                <td class="px-4 py-3 text-xs">Invalid license key or product slug.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 font-mono text-orange-400">400 Bad Req</td>
                                                <td class="px-4 py-3 text-xs">Missing <code class="font-mono text-[10px]">hardware_id</code> in payload.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-800">

                <section class="scroll-mt-40" id="deactivate-license">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded text-xs font-bold tracking-wide border border-blue-500/20">POST</span>
                        <h3 class="text-xl font-bold text-white">Raw API: Deactivate / Revoke Device</h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Releases an activation slot by removing the specific hardware ID from the license. Useful when a user uninstalls the app or moves to a new computer.
                    </p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <h4 class="text-sm font-semibold text-gray-300">Endpoint Structure</h4>
                            <code class="block w-full bg-[#111] border border-gray-800 rounded-lg p-3 text-sm font-mono text-gray-300">
                                /api/v1/licenses/deactivate
                            </code>

                            <h4 class="text-sm font-semibold text-gray-300 pt-3">Request Body (JSON)</h4>
                            <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden relative group">
                                <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"license_key"</span>: <span class="text-green-400">"BWEAL-E8VUG-GDYHY-ZFZBM-YZAFZ"</span>,
  <span class="text-blue-400">"product_slug"</span>: <span class="text-green-400">"awesome-app-xVt91"</span>,
  <span class="text-blue-400">"hardware_id"</span>: <span class="text-green-400">"00:1A:2B:3C:4D:5E"</span>
}</code></pre>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h4 class="text-sm font-semibold text-gray-300 pt-3">Success Response (200 OK)</h4>
                            <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden">
                                <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"status"</span>: <span class="text-green-400">"success"</span>,
  <span class="text-blue-400">"message"</span>: <span class="text-green-400">"License successfully deactivated for this device. The slot is now free."</span>
}</code></pre>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-layouts.app>
