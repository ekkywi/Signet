<x-layouts.app title="Signet | Licenses">

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

            <h2 class="text-2xl font-bold text-white tracking-tight">Licenses</h2>
            <p class="text-sm text-gray-500 mt-1">Issue and manage license keys for your registered products.</p>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        <div class="bg-[#111] border border-gray-800 rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Generate New License</h3>

            <form action="{{ route("licenses.store") }}" class="space-y-6" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Product</label>
                        <div class="relative">
                            <select class="appearance-none block w-full rounded-xl border-0 bg-[#0a0a0a] pl-4 pr-10 py-3 text-white ring-1 ring-inset ring-gray-800 focus:ring-teal-500 transition-all cursor-pointer" name="product_id" required>
                                <option value="">Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Max Devices</label>
                        <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white ring-1 ring-inset ring-gray-800 focus:ring-teal-500 transition-all" min="1" name="max_activations" required type="number" value="1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Expiration Date (Optional)</label>
                        <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white ring-1 ring-inset ring-gray-800 focus:ring-teal-500 transition-all cursor-pointer" id="expires_at" name="expires_at" placeholder="Select expiration date..." type="text">
                        <p class="text-xs text-gray-600 mt-1.5">Leave blank for a Lifetime license.</p>
                    </div>

                    <div class="flex items-center pt-2 md:pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" name="require_hardware_lock" type="checkbox" value="1">
                            <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-400">Require Hardware Lock</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button class="bg-teal-600 hover:bg-teal-500 text-white px-8 py-3 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-teal-500/20" type="submit">
                        Generate License Key
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">License Key</th>
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Security</th>
                            <th class="px-6 py-4">Expires</th>
                            <th class="px-6 py-4">Usage</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($licenses as $license)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <code class="text-teal-400 font-mono font-bold">{{ $license->key }}</code>
                                </td>
                                <td class="px-6 py-4 text-white">
                                    {{ $license->product->name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($license->require_hardware_lock)
                                        <span class="flex items-center gap-1.5 text-xs text-blue-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                            </svg>
                                            Hardware Locked
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-500">Floating License</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($license->expires_at)
                                        <span class="text-xs text-gray-300">{{ $license->expires_at->format("d M Y") }}</span>
                                    @else
                                        <span class="text-[11px] font-bold tracking-wide text-teal-400 bg-teal-500/10 px-2.5 py-1 rounded-full">LIFETIME</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-800/40 text-gray-300 hover:text-white hover:bg-teal-500/20 transition-all border border-gray-700/50 hover:border-teal-500/40 text-xs font-medium group" href="{{ route("licenses.show", $license->id) }}">
                                        {{ $license->activations_count }} / {{ $license->max_activations }} Devices
                                        <svg class="w-3.5 h-3.5 text-gray-500 group-hover:text-teal-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route("licenses.destroy", $license->id) }}" class="hidden" id="revoke-form-{{ $license->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>

                                    <button class="text-gray-500 hover:text-red-500 font-medium text-xs transition-colors px-3 py-1.5 rounded hover:bg-red-500/10" onclick="triggerRevoke('revoke-form-{{ $license->id }}')" type="button">
                                        Revoke
                                    </button>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-[100] hidden flex items-center justify-center" id="license-modal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeLicenseModal()"></div>

        <div class="relative bg-[#111] border border-gray-800 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="license-modal-panel">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0 border border-red-500/20">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Revoke License Key</h3>
                </div>
            </div>

            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                Are you sure you want to revoke this license? The client application using this key will <span class="text-red-400 font-bold">immediately lose access</span> to your software.
            </p>

            <div class="flex items-center justify-end gap-3">
                <button class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" onclick="closeLicenseModal()" type="button">
                    Cancel
                </button>
                <button class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-500 text-white shadow-lg shadow-red-500/20 transition-all active:scale-95" onclick="executeRevoke()" type="button">
                    Yes, Revoke License
                </button>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://npmcdn.com/flatpickr/dist/themes/dark.css" rel="stylesheet" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#expires_at", {
                minDate: "today",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: false,
                disableMobile: "true"
            });
        });
    </script>

    <script>
        let formIdToSubmit = null;
        const lModal = document.getElementById('license-modal');
        const lPanel = document.getElementById('license-modal-panel');

        function triggerRevoke(fId) {
            formIdToSubmit = fId;
            lModal.classList.remove('hidden');
            setTimeout(() => {
                lPanel.classList.remove('scale-95', 'opacity-0');
                lPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeLicenseModal() {
            lPanel.classList.remove('scale-100', 'opacity-100');
            lPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                lModal.classList.add('hidden');
            }, 300);
        }

        function executeRevoke() {
            if (formIdToSubmit) {
                document.getElementById(formIdToSubmit).submit();
            }
        }
    </script>

</x-layouts.app>
