<x-layouts.app title="Products - Signet">

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

            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Products</h2>
                <p class="text-sm text-gray-500 mt-1">Register the software applications you want to protect with Signet.</p>
            </div>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-teal-500/5 rounded-full blur-3xl"></div>

            <h3 class="text-lg font-semibold text-white mb-6 relative z-10">Add New Product</h3>

            <form action="{{ route("products.store") }}" class="relative z-10 space-y-4" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Product Name <span class="text-red-500">*</span></label>
                        <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 focus:ring-teal-500 sm:text-sm transition-all" name="name" placeholder="e.g. Proxmox Manager V1" required type="text">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Description (Optional)</label>
                        <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 focus:ring-teal-500 sm:text-sm transition-all" name="description" placeholder="Internal notes about this software" type="text">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button class="bg-teal-600 hover:bg-teal-500 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-teal-500/20 flex items-center gap-2" type="submit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        Save Product
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Product Name</th>
                            <th class="px-6 py-4">Identifier (Slug)</th>
                            <th class="px-6 py-4">Total Licenses</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($products as $product)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-white block">{{ $product->name }}</span>
                                    <span class="text-xs text-gray-500 mt-0.5 block truncate max-w-xs">{{ $product->description ?? "No description" }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="text-teal-400 font-mono text-xs bg-[#0a0a0a] px-2 py-1 rounded border border-gray-800">{{ $product->slug }}</code>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gray-800 rounded-full">
                                        {{ $product->licenses_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route("products.destroy", $product->id) }}" id="delete-form-{{ $product->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="text-gray-500 hover:text-red-500 font-medium text-xs transition-colors px-3 py-1.5 rounded hover:bg-red-500/10" onclick="openDeleteModal('delete-form-{{ $product->id }}')" type="button">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-16 text-center" colspan="4">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12 mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        </svg>
                                        <p class="text-base font-medium text-gray-400 mb-1">No products registered</p>
                                        <p class="text-sm">Add your first software product above to start issuing licenses.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="fixed inset-0 z-[100] hidden flex items-center justify-center" id="delete-modal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

        <div class="relative bg-[#111] border border-gray-800 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="delete-modal-panel">

            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0 border border-red-500/20">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Delete Product</h3>
                </div>
            </div>

            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                Are you absolutely sure you want to delete this product?
                <span class="text-red-400 font-medium block mt-2">Warning: All licenses associated with this product will also be permanently deleted. This action cannot be undone.</span>
            </p>

            <div class="flex items-center justify-end gap-3">
                <button class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" onclick="closeDeleteModal()" type="button">
                    Cancel
                </button>
                <button class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-500 text-white shadow-lg shadow-red-500/20 transition-all active:scale-95" onclick="submitDeleteForm()" type="button">
                    Yes, Delete Product
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteFormId = null;
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalPanel = document.getElementById('delete-modal-panel');

        function openDeleteModal(formId) {
            currentDeleteFormId = formId;
            deleteModal.classList.remove('hidden');

            setTimeout(() => {
                deleteModalPanel.classList.remove('scale-95', 'opacity-0');
                deleteModalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            deleteModalPanel.classList.remove('scale-100', 'opacity-100');
            deleteModalPanel.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                deleteModal.classList.add('hidden');
                currentDeleteFormId = null;
            }, 300);
        }

        function submitDeleteForm() {
            if (currentDeleteFormId) {
                document.getElementById(currentDeleteFormId).submit();
            }
        }
    </script>
</x-layouts.app>
