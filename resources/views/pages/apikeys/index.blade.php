<x-layouts.app title="API & Credentials - Signet">

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full">

            @if (session("success"))
                <div class="mb-6 bg-teal-500/10 border border-teal-500/50 text-teal-400 px-6 py-4 rounded-xl flex items-center gap-3 shadow-lg shadow-teal-500/10 animate-fade-in-down">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <span class="font-medium text-sm">{{ session("success") }}</span>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">API & Security Credentials</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage secret tokens and cryptographic keys to authenticate your applications.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full pb-20">

        <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-5 flex gap-4 items-start">
            <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-blue-400 mb-1">Understanding Your Keys</h4>
                <p class="text-sm text-blue-300/80 leading-relaxed">
                    Your <strong>API Key</strong> is highly classified and should only be placed in secure <code class="bg-blue-900/50 px-1 rounded">.env</code> files.
                    However, your <strong>ECDSA Public Key</strong> is safe to be distributed within your compiled client applications as it can only <em>verify</em> signatures, not create them.
                </p>
            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="px-6 py-5 border-b border-gray-800 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-white">Cryptographic Public Key</h3>
                    <p class="text-sm text-gray-500 mt-1">Used by your client SDK to verify hardware signatures offline.</p>
                </div>
                <span class="bg-teal-500/10 text-teal-400 border border-teal-500/20 px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase">
                    Secp256r1
                </span>
            </div>

            <div class="p-6">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">SIGNET_PUBLIC_KEY</label>
                <div class="relative group">
                    <textarea class="w-full bg-[#0a0a0a] border border-gray-700 text-teal-400 font-mono text-sm rounded-xl p-4 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 outline-none resize-none transition-all" id="publicKeyText" readonly rows="4">{{ $publicKey }}</textarea>

                    <button class="absolute top-3 right-3 bg-gray-800 hover:bg-gray-700 text-gray-300 text-xs px-3 py-1.5 rounded-lg font-medium transition-all flex items-center gap-2 border border-gray-600" onclick="copyPublicKey(this)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <span>Copy Key</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 relative overflow-hidden shadow-xl">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-teal-500/5 rounded-full blur-3xl"></div>

            <h3 class="text-lg font-bold text-white mb-2 relative z-10">REST API Keys</h3>
            <p class="text-sm text-gray-400 mb-6 relative z-10">Create secret tokens to authenticate your server-side API requests. Give your key a descriptive name (e.g., Production Server).</p>

            <form action="{{ route("apikeys.store") }}" class="flex flex-col sm:flex-row gap-4 relative z-10" method="POST">
                @csrf
                <div class="flex-1">
                    <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white shadow-sm ring-1 ring-inset @error("name") ring-red-500 focus:ring-red-500 @else ring-gray-800 focus:ring-teal-500 @enderror sm:text-sm sm:leading-6 transition-all" name="name" placeholder="Key Name" required type="text">
                    @error("name")
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button class="bg-teal-600 hover:bg-teal-500 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-teal-500/20 whitespace-nowrap flex items-center justify-center gap-2" type="submit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Generate Key
                </button>
            </form>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Secret Token</th>
                            <th class="px-6 py-4">Created</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($apiKeys as $key)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-white flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg>
                                        {{ $key->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="inline-flex items-center gap-2 bg-[#0a0a0a] border border-gray-800 rounded-lg px-3 py-1.5 group-hover:border-gray-700 transition-colors">
                                        <code class="text-teal-400 font-mono text-xs tracking-wider">{{ $key->token }}</code>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $key->created_at->format("M d, Y") }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route("apikeys.destroy", $key->id) }}" id="revoke-form-{{ $key->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="text-gray-500 hover:text-red-500 font-medium text-xs transition-colors px-3 py-1.5 rounded bg-transparent hover:bg-red-500/10" onclick="openRevokeModal('revoke-form-{{ $key->id }}')" type="button">
                                            Revoke
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-16 text-center" colspan="4">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12 mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        </svg>
                                        <p class="text-base font-medium text-gray-400 mb-1">No API keys generated</p>
                                        <p class="text-sm">Create a secret key above to start authenticating your applications.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="fixed inset-0 z-[100] hidden flex items-center justify-center" id="revoke-modal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeRevokeModal()"></div>

        <div class="relative bg-[#111] border border-gray-800 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="revoke-modal-panel">

            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0 border border-red-500/20">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Revoke API Key</h3>
                </div>
            </div>

            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                Are you absolutely sure? Any application currently using this secret token will immediately lose access to Signet.
                <span class="text-gray-200 font-medium block mt-2">This action cannot be undone.</span>
            </p>

            <div class="flex items-center justify-end gap-3">
                <button class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" onclick="closeRevokeModal()" type="button">
                    Cancel
                </button>
                <button class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-500 text-white shadow-lg shadow-red-500/20 transition-all active:scale-95" onclick="submitRevokeForm()" type="button">
                    Yes, Revoke Key
                </button>
            </div>
        </div>
    </div>

    <script>
        function copyPublicKey(btn) {
            const textArea = document.getElementById('publicKeyText');
            textArea.select();
            textArea.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(textArea.value).then(() => {
                const originalText = btn.innerHTML;
                btn.innerHTML = `<svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-green-400">Copied!</span>`;
                btn.classList.add('border-green-500/50', 'bg-green-500/10');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('border-green-500/50', 'bg-green-500/10');
                }, 2000);
            });
        }

        let currentFormIdToSubmit = null;
        const revokeModal = document.getElementById('revoke-modal');
        const revokeModalPanel = document.getElementById('revoke-modal-panel');

        function openRevokeModal(formId) {
            currentFormIdToSubmit = formId;
            revokeModal.classList.remove('hidden');
            setTimeout(() => {
                revokeModalPanel.classList.remove('scale-95', 'opacity-0');
                revokeModalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeRevokeModal() {
            revokeModalPanel.classList.remove('scale-100', 'opacity-100');
            revokeModalPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                revokeModal.classList.add('hidden');
                currentFormIdToSubmit = null;
            }, 300);
        }

        function submitRevokeForm() {
            if (currentFormIdToSubmit) {
                document.getElementById(currentFormIdToSubmit).submit();
            }
        }
    </script>
</x-layouts.app>
