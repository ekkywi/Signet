<x-layouts.app title="API Documentation - Signet">

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
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">API Endpoints</h4>
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

                <section class="scroll-mt-40" id="validate-license">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded text-xs font-bold tracking-wide border border-blue-500/20">POST</span>
                        <h3 class="text-xl font-bold text-white">Validate License</h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Verifies a license key, checks its expiration, and registers the client's hardware ID to consume an activation slot.
                    </p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <h4 class="text-sm font-semibold text-gray-300">Endpoint Structure</h4>
                            <code class="block w-full bg-[#111] border border-gray-800 rounded-lg p-3 text-sm font-mono text-gray-300">
                                /api/v1/licenses/validate
                            </code>

                            <h4 class="text-sm font-semibold text-gray-300 pt-3">Request Body (JSON)</h4>
                            <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden relative group">
                                <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"license_key"</span>: <span class="text-green-400">"ABCD-EFGH-IJKL-MNOP"</span>,
  <span class="text-blue-400">"product_slug"</span>: <span class="text-green-400">"your-product-slug"</span>,
  <span class="text-blue-400">"hardware_id"</span>: <span class="text-green-400">"MAC-ADDRESS-OR-UUID"</span>,
  <span class="text-blue-400">"device_name"</span>: <span class="text-green-400">"DESKTOP-GAMING"</span> <span class="text-gray-600">// Optional</span>
}</code></pre>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h4 class="text-sm font-semibold text-gray-300">Success Response (200 OK)</h4>
                            <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden">
                                <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"status"</span>: <span class="text-green-400">"success"</span>,
  <span class="text-blue-400">"message"</span>: <span class="text-green-400">"License is valid."</span>,
  <span class="text-blue-400">"data"</span>: {
    <span class="text-blue-400">"product"</span>: <span class="text-green-400">"Awesome App"</span>,
    <span class="text-blue-400">"type"</span>: <span class="text-green-400">"node-locked"</span>,
    <span class="text-blue-400">"expires_at"</span>: <span class="text-green-400">"lifetime"</span>
  }
}</code></pre>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-800">

                <section class="scroll-mt-40" id="deactivate-license">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded text-xs font-bold tracking-wide border border-blue-500/20">POST</span>
                        <h3 class="text-xl font-bold text-white">Deactivate / Revoke Device</h3>
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
  <span class="text-blue-400">"license_key"</span>: <span class="text-green-400">"ABCD-EFGH-IJKL-MNOP"</span>,
  <span class="text-blue-400">"product_slug"</span>: <span class="text-green-400">"your-product-slug"</span>,
  <span class="text-blue-400">"hardware_id"</span>: <span class="text-green-400">"MAC-ADDRESS-OR-UUID"</span>
}</code></pre>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h4 class="text-sm font-semibold text-gray-300">Success Response (200 OK)</h4>
                            <div class="bg-[#111] border border-gray-800 rounded-xl overflow-hidden">
                                <pre class="p-4 text-sm font-mono text-gray-400 overflow-x-auto"><code>{
  <span class="text-blue-400">"status"</span>: <span class="text-green-400">"success"</span>,
  <span class="text-blue-400">"message"</span>: <span class="text-green-400">"License successfully deactivated."</span>
}</code></pre>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-layouts.app>
