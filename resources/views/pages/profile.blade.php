<x-layouts.app title="Signet | Account Settings">

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-20">
        <div class="max-w-4xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">Account Settings</h2>
            <p class="text-sm text-gray-500 mt-1">Manage your security preferences and personal data.</p>
        </div>
    </div>

    <div class="p-8 max-w-4xl mx-auto w-full space-y-8">

        @if (session("success"))
            <div class="bg-teal-500/10 border border-teal-500/50 text-teal-400 px-6 py-4 rounded-xl flex items-center gap-3 shadow-lg shadow-teal-500/10 animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span class="font-medium text-sm">{{ session("success") }}</span>
            </div>
        @endif

        <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl flex items-center gap-6">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-teal-500/20 to-purple-500/20 border border-gray-700 flex items-center justify-center flex-shrink-0">
                <span class="text-2xl font-bold text-gray-300">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                <p class="text-gray-400 text-sm mt-1">{{ $user->email }}</p>
                <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-800/50 text-gray-400 text-xs font-medium border border-gray-700/50">
                    Regular User
                </div>
            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="px-6 py-5 border-b border-gray-800 bg-[#0a0a0a]">
                <h3 class="text-base font-semibold text-white">Update Password</h3>
                <p class="text-sm text-gray-500 mt-0.5">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <form action="{{ route("profile.password.update") }}" class="p-6 space-y-6" method="POST">
                @csrf
                @method("PUT")

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2" for="current_password">Current Password</label>
                    <input class="w-full bg-[#0a0a0a] border border-gray-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-colors" id="current_password" name="current_password" required type="password">
                    @error("current_password")
                        <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2" for="password">New Password</label>
                        <input class="w-full bg-[#0a0a0a] border border-gray-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-colors" id="password" name="password" required type="password">
                        @error("password")
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2" for="password_confirmation">Confirm Password</label>
                        <input class="w-full bg-[#0a0a0a] border border-gray-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-colors" id="password_confirmation" name="password_confirmation" required type="password">
                    </div>
                </div>

                <div class="pt-2">
                    <button class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-white text-black hover:bg-gray-200 transition-all shadow-lg active:scale-95" type="submit">
                        Save Password
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-red-500/5 border border-red-500/20 rounded-2xl overflow-hidden shadow-xl">
            <div class="px-6 py-5 border-b border-red-500/10 bg-red-500/5">
                <h3 class="text-base font-semibold text-red-500 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Danger Zone
                </h3>
            </div>

            <div class="p-6">
                <p class="text-sm text-gray-400 leading-relaxed mb-6">
                    Once your account is deleted, all of its resources and data (including workspaces, products, and active licenses) will be permanently deleted. This action cannot be undone. Please download any data or information that you wish to retain before deleting your account.
                </p>
                <button class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-red-600/10 text-red-500 border border-red-500/20 hover:bg-red-600 hover:text-white transition-all active:scale-95" onclick="triggerDeleteModal()" type="button">
                    Delete Account
                </button>
            </div>
        </div>

    </div>

    <div class="fixed inset-0 z-[100] hidden flex items-center justify-center" id="delete-modal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

        <div class="relative bg-[#111] border border-gray-800 rounded-2xl p-6 w-full max-w-lg shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="delete-modal-panel">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0 border border-red-500/20">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Are you absolutely sure?</h3>
                </div>
            </div>

            <form action="{{ route("profile.destroy") }}" id="delete-account-form" method="POST">
                @csrf
                @method("DELETE")

                <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                    This action is <span class="text-white font-bold">irreversible</span>. It will permanently delete your account, workspace, and instantly invalidate all active client licenses globally.
                </p>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2" for="password_delete">Please enter your password to confirm</label>
                    <input class="w-full bg-[#0a0a0a] border border-gray-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-colors" id="password_delete" name="password" placeholder="Your current password" required type="password">
                    @error("password", "userDeletion")
                        <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 bg-[#0a0a0a] -mx-6 -mb-6 px-6 py-4 border-t border-gray-800 rounded-b-2xl">
                    <button class="px-4 py-2 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" onclick="closeDeleteModal()" type="button">
                        Cancel
                    </button>
                    <button class="px-4 py-2 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-500 text-white shadow-lg shadow-red-500/20 transition-all active:scale-95" type="submit">
                        Yes, delete my account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const dModal = document.getElementById('delete-modal');
        const dPanel = document.getElementById('delete-modal-panel');

        function triggerDeleteModal() {
            dModal.classList.remove('hidden');
            setTimeout(() => {
                dPanel.classList.remove('scale-95', 'opacity-0');
                dPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            dPanel.classList.remove('scale-100', 'opacity-100');
            dPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                dModal.classList.add('hidden');
            }, 300);
        }

        @if ($errors->has("password") && session("_old_input._method") === "DELETE")
            triggerDeleteModal();
        @endif
    </script>
</x-layouts.app>
