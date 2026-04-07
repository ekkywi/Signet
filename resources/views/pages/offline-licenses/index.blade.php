<x-layouts.app title="Signet | Offline Generator">

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full">

            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/50 text-red-400 px-6 py-4 rounded-xl shadow-lg shadow-red-500/10 animate-fade-in-down">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <span class="font-bold text-sm">Failed to Generate License!</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 ml-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="text-2xl font-bold text-white tracking-tight">Offline Generator</h2>
            <p class="text-sm text-gray-500 mt-1">Generate <code class="text-teal-400 bg-teal-400/10 px-1.5 py-0.5 rounded text-xs">license.json</code> files manually for Air-Gapped client machines.</p>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl">
                    <h3 class="text-lg font-semibold text-white mb-6">Device Locking Details</h3>

                    <form action="{{ route("offline-licenses.store") }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2" for="license_key">
                                    Target License Key
                                </label>
                                <div class="relative">
                                    <input class="appearance-none block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white ring-1 ring-inset ring-gray-800 focus:ring-teal-500 transition-all sm:text-sm" id="license_key" name="license_key" placeholder="e.g. LUWNU-Z8KCF-FZJMR..." required type="text" value="{{ old("license_key") }}">
                                </div>
                                <p class="mt-2 text-xs text-gray-600">Enter the exact license key assigned to the client.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2" for="hardware_id">
                                    Machine Fingerprint <span class="text-gray-600 font-normal">(Hardware ID)</span>
                                </label>
                                <div class="relative">
                                    <input class="appearance-none block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-teal-400 font-mono tracking-wide ring-1 ring-inset ring-gray-800 focus:ring-teal-500 focus:ring-2 transition-all sm:text-sm" id="hardware_id" minlength="32" name="hardware_id" pattern="[a-zA-Z0-9]+" placeholder="e.g. e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855" required title="Hardware ID must be a valid alphanumeric hash" type="text" value="{{ old("hardware_id") }}">
                                </div>
                                <p class="mt-2 text-xs text-gray-600">The unique identifier extracted from the client's offline machine.</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-800 flex justify-end">
                            <button class="flex items-center gap-2 bg-teal-600 hover:bg-teal-500 text-white px-8 py-3 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-teal-500/20" type="submit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                Sign & Download JSON
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-teal-500/5 border border-teal-500/20 rounded-2xl p-6 sticky top-32">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <h3 class="text-white font-semibold text-sm">Air-Gapped Activation Flow</h3>
                    </div>

                    <ul class="text-sm text-gray-400 space-y-4">
                        <li class="flex gap-3">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#0a0a0a] border border-gray-700 flex items-center justify-center text-xs text-gray-300">1</span>
                            <span>The client extracts the <strong class="text-teal-400 font-medium">Hardware ID</strong> from their offline machine through your application's interface.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#0a0a0a] border border-gray-700 flex items-center justify-center text-xs text-gray-300">2</span>
                            <span>Enter the ID along with the client's <strong class="text-white font-medium">License Key</strong> into this form.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#0a0a0a] border border-gray-700 flex items-center justify-center text-xs text-gray-300">3</span>
                            <span>Signet will process the data and request a cryptographic signature from the HSM module locally.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-[#0a0a0a] border border-gray-700 flex items-center justify-center text-xs text-gray-300">4</span>
                            <span>Move the downloaded <code class="bg-[#0a0a0a] text-gray-300 px-1 py-0.5 rounded border border-gray-800 text-xs">license.json</code> file to the client's machine using physical storage media (e.g., USB flash drive).</span>
                        </li>
                    </ul>

                    <div class="mt-6 pt-5 border-t border-teal-500/10">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <div class="text-xs text-gray-500 leading-relaxed">
                                <span class="font-semibold text-gray-400">Important for Users:</span>
                                The <code class="bg-[#0a0a0a] text-gray-400 px-1 py-0.5 rounded border border-gray-800 text-[10px]">license.json</code> file generated is cryptographically locked. Remind users <strong>not to open or edit the contents of this file</strong>. Changing even a single character (including spaces) will break the digital signature and permanently deny access to the application.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layouts.app>
