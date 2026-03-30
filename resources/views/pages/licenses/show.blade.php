<x-layouts.app title="Signet | License Details">

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
                <div class="flex items-center gap-4">
                    <a class="w-10 h-10 rounded-xl bg-gray-800/50 hover:bg-gray-700/50 flex items-center justify-center text-gray-400 hover:text-white transition-all border border-gray-700/50" href="{{ route("licenses.index") }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-white tracking-tight">License Details</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage active devices and configuration.</p>
                    </div>
                </div>

                <button class="flex items-center gap-2 bg-[#111] hover:bg-gray-800 border border-gray-800 text-gray-300 px-4 py-2 rounded-xl text-sm font-semibold transition-all shadow-lg" onclick="openEditModal()" type="button">
                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Extend License
                </button>
            </div>

        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="flex flex-col divide-y divide-gray-800">

                <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-white/[0.02] transition-colors">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">License Key</p>
                    <code class="text-base text-teal-400 font-mono font-bold bg-black/50 border border-gray-800/50 px-3 py-1.5 rounded-lg">
                        {{ $license->key }}
                    </code>
                </div>

                <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-white/[0.02] transition-colors">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Product</p>
                    <p class="text-base text-white font-semibold">{{ $license->product->name }}</p>
                </div>

                <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-white/[0.02] transition-colors">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Security Type</p>
                    <div>
                        @if ($license->require_hardware_lock)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md bg-blue-500/10 text-blue-400 text-xs font-medium border border-blue-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                Node Locked
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md bg-gray-500/10 text-gray-400 text-xs font-medium border border-gray-500/20">
                                Floating
                            </span>
                        @endif
                    </div>
                </div>

                <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-white/[0.02] transition-colors">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Expiration</p>
                    <div>
                        @if ($license->expires_at)
                            <span class="text-base font-medium text-gray-300">{{ $license->expires_at->format("F j, Y") }}</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1.5 rounded-md bg-teal-500/10 text-teal-400 text-xs font-bold tracking-wide border border-teal-500/20">
                                LIFETIME
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="px-6 py-5 border-b border-gray-800 flex items-center justify-between bg-[#0a0a0a]">
                <div>
                    <h3 class="text-base font-semibold text-white">Active Devices</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Showing {{ $license->activations_count }} of {{ $license->max_activations }} allowed devices.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Device Name</th>
                            <th class="px-6 py-4">Hardware ID / Identifier</th>
                            <th class="px-6 py-4">Last Active</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($license->activations as $device)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $device->device_name }}
                                </td>
                                <td class="px-6 py-4">
                                    <code class="text-xs bg-gray-800/50 px-2 py-1 rounded text-gray-300">{{ $device->hardware_identifier }}</code>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    {{ $device->last_active_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route("licenses.revoke-device", $device->id) }}" class="hidden" id="revoke-device-form-{{ $device->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>

                                    <button class="text-gray-500 hover:text-red-400 font-medium text-xs transition-colors px-3 py-1.5 rounded hover:bg-red-500/10" onclick="triggerRevoke('revoke-device-form-{{ $device->id }}')" type="button">
                                        Revoke Device
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-12 text-center text-gray-500" colspan="4">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                        </svg>
                                        <p>No devices have activated this license yet.</p>
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
                    <h3 class="text-lg font-bold text-white tracking-tight">Revoke Device</h3>
                </div>
            </div>

            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                Are you sure you want to revoke this device? This will <span class="text-white font-bold">free up one activation slot</span>, but the client application on this device will lose access immediately.
            </p>

            <div class="flex items-center justify-end gap-3">
                <button class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" onclick="closeRevokeModal()" type="button">
                    Cancel
                </button>
                <button class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-500 text-white shadow-lg shadow-red-500/20 transition-all active:scale-95" onclick="executeRevoke()" type="button">
                    Yes, Revoke Device
                </button>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-[100] hidden flex items-center justify-center" id="edit-modal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>

        <div class="relative bg-[#111] border border-gray-800 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="edit-modal-panel">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 rounded-full bg-teal-500/10 flex items-center justify-center flex-shrink-0 border border-teal-500/20">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Extend License</h3>
                </div>
            </div>

            <form action="{{ route("licenses.update", $license->id) }}" method="POST">
                @csrf
                @method("PUT")

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-400 mb-2">New Expiration Date</label>
                    <input class="block w-full rounded-xl border-0 bg-[#0a0a0a] px-4 py-3 text-white ring-1 ring-inset ring-gray-800 focus:ring-teal-500 transition-all cursor-pointer" id="edit_expires_at" name="expires_at" placeholder="Select new date..." type="text" value="{{ $license->expires_at ? $license->expires_at->format("Y-m-d") : "" }}">
                    <p class="text-xs text-gray-600 mt-2">Leave blank to make it a Lifetime license.</p>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" onclick="closeEditModal()" type="button">
                        Cancel
                    </button>
                    <button class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-teal-600 hover:bg-teal-500 text-white shadow-lg shadow-teal-500/20 transition-all active:scale-95" type="submit">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://npmcdn.com/flatpickr/dist/themes/dark.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#edit_expires_at", {
                minDate: "today",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: false,
                disableMobile: "true"
            });
        });

        let formIdToSubmit = null;
        const rModal = document.getElementById('revoke-modal');
        const rPanel = document.getElementById('revoke-modal-panel');

        function triggerRevoke(fId) {
            formIdToSubmit = fId;
            rModal.classList.remove('hidden');
            setTimeout(() => {
                rPanel.classList.remove('scale-95', 'opacity-0');
                rPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeRevokeModal() {
            rPanel.classList.remove('scale-100', 'opacity-100');
            rPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                rModal.classList.add('hidden');
            }, 300);
        }

        function executeRevoke() {
            if (formIdToSubmit) {
                document.getElementById(formIdToSubmit).submit();
            }
        }

        const editModal = document.getElementById('edit-modal');
        const editModalPanel = document.getElementById('edit-modal-panel');

        function openEditModal() {
            editModal.classList.remove('hidden');
            setTimeout(() => {
                editModalPanel.classList.remove('scale-95', 'opacity-0');
                editModalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditModal() {
            editModalPanel.classList.remove('scale-100', 'opacity-100');
            editModalPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                editModal.classList.add('hidden');
            }, 300);
        }
    </script>
</x-layouts.app>
