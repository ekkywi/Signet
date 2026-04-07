<x-layouts.app title="Signet | API & Credentials">

    <div class="px-8 py-6 border-b border-gray-800/80 bg-[#0a0a0a]/80 sticky top-0 backdrop-blur-xl z-20">
        <div class="max-w-7xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">API & Security Credentials</h2>
            <p class="text-sm text-gray-400 mt-1">Manage secret tokens and cryptographic keys to authenticate your server-side requests.</p>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full pb-24">
        @if (session("success"))
            <div class="bg-teal-500/10 border border-teal-500/30 text-teal-400 px-5 py-4 rounded-xl flex items-center gap-3 animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span class="font-medium text-sm">{{ session("success") }}</span>
            </div>
        @endif

        @if (session("new_api_key"))
            <div class="bg-amber-500/10 border border-amber-500/30 p-6 rounded-xl animate-fade-in-down">
                <div class="flex items-start gap-4">
                    <div class="bg-amber-500/20 p-2 rounded-lg flex-shrink-0 mt-1">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <div class="w-full">
                        <h3 class="text-lg font-bold text-amber-500 mb-1">Save your new API Key</h3>
                        <p class="text-sm text-amber-200/70 mb-5">
                            Please copy this key and store it securely. For your protection, you won't be able to see it again after you navigate away from this page.
                        </p>

                        <div class="flex items-center gap-3 bg-[#000] border border-gray-800 rounded-lg p-2 pl-4">
                            <code class="text-amber-400 font-mono text-sm tracking-wider flex-1 select-all break-all" id="new-api-key-text">{{ session("new_api_key") }}</code>
                            <button class="bg-gray-800 hover:bg-gray-700 text-white px-5 py-2.5 rounded-md text-xs font-semibold transition-colors flex-shrink-0 border border-gray-700" onclick="copyApiKey('{{ session("new_api_key") }}', this)">
                                Copy Key
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-[#111] border border-gray-800/80 rounded-2xl p-7 shadow-sm">
            <h3 class="text-lg font-semibold text-white mb-1">Generate API Key</h3>
            <p class="text-sm text-gray-400 mb-6">Create a new token to grant an application access to the Signet API.</p>

            <form action="{{ route("apikeys.store") }}" class="flex flex-col sm:flex-row gap-4" method="POST">
                @csrf
                <div class="flex-1">
                    <label class="sr-only" for="key_name">Key Name</label>
                    <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3.5 text-white shadow-sm ring-1 ring-inset @error("name") ring-red-500 focus:ring-red-500 @else ring-gray-700 focus:ring-teal-500 @enderror sm:text-sm sm:leading-6 transition-all" id="key_name" name="name" placeholder="e.g., Production Payment Gateway" required type="text">
                    @error("name")
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button class="bg-teal-600 hover:bg-teal-500 text-white px-6 py-3.5 rounded-xl text-sm font-semibold transition-all shadow-sm flex items-center justify-center gap-2 flex-shrink-0 h-fit" type="submit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Create Secret Key
                </button>
            </form>
        </div>

        <div class="bg-[#111] border border-gray-800/80 rounded-2xl overflow-hidden shadow-sm">
            <div class="px-7 py-5 border-b border-gray-800/80 flex items-center justify-between bg-[#111]">
                <h3 class="text-base font-semibold text-white">Active Keys</h3>
                <span class="text-xs font-medium text-gray-500 bg-gray-800/50 px-2.5 py-1 rounded-full">{{ count($apiKeys) }} total</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a]/50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-7 py-4 font-medium">Name</th>
                            <th class="px-7 py-4 font-medium">Token Prefix</th>
                            <th class="px-7 py-4 font-medium">Created On</th>
                            <th class="px-7 py-4 text-right font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800/60">
                        @forelse ($apiKeys as $key)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-7 py-4">
                                    <span class="font-medium text-gray-200">{{ $key->name }}</span>
                                </td>
                                <td class="px-7 py-4">
                                    <div class="inline-flex items-center gap-1.5 bg-[#0a0a0a] border border-gray-800 rounded px-2.5 py-1">
                                        <code class="text-gray-500 font-mono text-[11px] tracking-widest">
                                            sgnt_live_••••••••••••••••••••{{ $key->last_chars ?? "••••" }}
                                        </code>
                                    </div>
                                </td>
                                <td class="px-7 py-4 text-gray-500">
                                    {{ $key->created_at->format("M d, Y") }}
                                </td>
                                <td class="px-7 py-4 text-right">
                                    <form action="{{ route("apikeys.destroy", $key->id) }}" id="revoke-form-{{ $key->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="text-red-400 hover:text-red-300 font-medium text-xs transition-colors px-3 py-1.5 rounded border border-transparent hover:border-red-500/30 hover:bg-red-500/10" onclick="openRevokeModal('revoke-form-{{ $key->id }}')" type="button">
                                            Revoke
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-7 py-20 text-center" colspan="4">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <div class="w-12 h-12 bg-gray-800/30 rounded-xl flex items-center justify-center mb-4 border border-gray-700/50">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-300 mb-1">No API keys found</p>
                                        <p class="text-xs text-gray-500">Generate a new key above to get started.</p>
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
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeRevokeModal()"></div>

        <div class="relative bg-[#111] border border-gray-800 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-95 opacity-0 transition-all duration-200 ease-out" id="revoke-modal-panel">
            <h3 class="text-lg font-bold text-white tracking-tight mb-2">Revoke API Key?</h3>
            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                Any application using this token will immediately lose access. <strong class="text-gray-200">This action cannot be undone.</strong>
            </p>

            <div class="flex items-center justify-end gap-3">
                <button class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-300 hover:text-white bg-gray-800/50 hover:bg-gray-800 transition-colors border border-gray-700" onclick="closeRevokeModal()" type="button">
                    Cancel
                </button>
                <button class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-500 text-white shadow-sm transition-all active:scale-95" onclick="submitRevokeForm()" type="button">
                    Revoke Key
                </button>
            </div>
        </div>
    </div>

    <script>
        function copyApiKey(token, element) {
            navigator.clipboard.writeText(token).then(() => {
                const originalContent = element.innerHTML;
                element.innerHTML = `
                    <svg class="w-4 h-4 text-green-400 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Copied
                `;
                element.classList.remove('bg-gray-800', 'text-white', 'hover:bg-gray-700');
                element.classList.add('bg-green-500/10', 'text-green-400', 'border-green-500/50');

                setTimeout(() => {
                    element.innerHTML = originalContent;
                    element.classList.remove('bg-green-500/10', 'text-green-400', 'border-green-500/50');
                    element.classList.add('bg-gray-800', 'text-white', 'hover:bg-gray-700');
                }, 2000);
            });
        }

        let currentFormIdToSubmit = null;
        const revokeModal = document.getElementById('revoke-modal');
        const revokeModalPanel = document.getElementById('revoke-modal-panel');

        function openRevokeModal(formId) {
            currentFormIdToSubmit = formId;
            revokeModal.classList.remove('hidden');
            requestAnimationFrame(() => {
                revokeModalPanel.classList.remove('scale-95', 'opacity-0');
                revokeModalPanel.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeRevokeModal() {
            revokeModalPanel.classList.remove('scale-100', 'opacity-100');
            revokeModalPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                revokeModal.classList.add('hidden');
                currentFormIdToSubmit = null;
            }, 200);
        }

        function submitRevokeForm() {
            if (currentFormIdToSubmit) {
                document.getElementById(currentFormIdToSubmit).submit();
            }
        }
    </script>
</x-layouts.app>
