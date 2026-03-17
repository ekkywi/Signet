<x-layouts.app title="API Keys - Signet">

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
                    <h2 class="text-2xl font-bold text-white tracking-tight">API Keys</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage secret tokens to authenticate your applications with Signet.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-teal-500/5 rounded-full blur-3xl"></div>

            <h3 class="text-lg font-semibold text-white mb-2 relative z-10">Create New Secret Key</h3>
            <p class="text-sm text-gray-400 mb-6 relative z-10">Give your key a descriptive name to remember where it is used (e.g., Production Server, Billing App).</p>

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
