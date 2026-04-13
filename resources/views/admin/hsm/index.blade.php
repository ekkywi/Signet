<x-layouts.admin title="Signet | Hardware Security Module">
    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Hardware Security Module</h2>
                <p class="text-sm text-gray-500 mt-1">Manage and monitor multiple HSM hardware nodes.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-red-600 hover:bg-red-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2 shadow-lg shadow-red-600/20" onclick="openModal('registerNodeModal')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Register New Node
                </button>
            </div>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        @if (session("enroll_command"))
            <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-6 animate-fade-in">
                <div class="flex items-start gap-4">
                    <div class="bg-emerald-500/20 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-emerald-400 font-bold">{{ session("success") }}</h4>
                        <p class="text-xs text-emerald-500/80 mt-1">Run the following command on your host machine to enroll the HSM node:</p>

                        <div class="mt-4 bg-black/40 border border-gray-800 rounded-xl p-4 flex items-center justify-between group">
                            <code class="text-gray-300 font-mono text-sm break-all" id="ztpCommandText">{{ session("enroll_command") }}</code>
                            <button class="ml-4 text-xs font-bold text-emerald-400 hover:text-emerald-300 uppercase tracking-widest transition-colors" onclick="copyToClipboard('{{ session("enroll_command") }}')">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($nodes as $node)
                @php
                    $isOnline = $node->status === "online";
                    $isBusy = $node->status === "busy";
                    $isOffline = in_array($node->status, ["offline", "error"]);

                    $cardBg = $isOffline ? "bg-[#0a0a0a] border-red-900/50 opacity-75" : ($isBusy ? "bg-[#111] border-orange-900/30 hover:border-orange-700/50" : "bg-[#111] border-gray-800 hover:border-gray-700");
                    $dotColor = $isOnline ? "bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.8)] animate-pulse" : ($isBusy ? "bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.8)]" : "bg-red-600");
                    $badgeStyle = $isOnline ? "bg-emerald-500/10 text-emerald-400 border-emerald-500/20" : ($isBusy ? "bg-orange-500/10 text-orange-400 border-orange-500/20" : "bg-red-500/10 text-red-500 border-red-500/20");
                @endphp

                <div class="{{ $cardBg }} rounded-2xl shadow-xl relative overflow-hidden transition-all flex flex-col">
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $dotColor }}"></span>
                                    {{ strtoupper($node->name) }}
                                </h4>
                                <p class="text-xs text-gray-500 font-mono mt-1">{{ $node->host_path }} • {{ $node->is_primary ? "Primary" : "Worker" }}</p>
                            </div>
                            <span class="{{ $badgeStyle }} text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider border">{{ $node->status }}</span>
                        </div>

                        @if ($isOffline)
                            <div class="flex flex-col items-center justify-center py-2 text-center">
                                <p class="text-xs text-red-400">Connection Lost</p>
                                <p class="text-[10px] text-gray-600 mt-1">
                                    {{ $node->last_ping_at ? "Last seen: " . $node->last_ping_at->diffForHumans() : "Waiting for initial enrollment..." }}
                                </p>
                            </div>
                        @else
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Temp</p>
                                    <p class="text-xl font-mono font-bold {{ $isBusy ? "text-red-400" : "text-white" }}">{{ $node->temperature ?? "--" }}<span class="text-xs text-gray-500 ml-1">°C</span></p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Queue</p>
                                    <p class="text-xl font-mono font-bold {{ $isBusy ? "text-orange-400" : "text-white" }}">0<span class="text-xs text-gray-500 ml-1">req</span></p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="border-t {{ $isOffline ? "border-red-900/30" : ($isBusy ? "border-orange-900/30" : "border-gray-800/60") }} bg-black/40 px-4 py-3 flex items-center justify-between">

                        <div class="flex gap-2">
                            <button {{ $isOffline ? "disabled" : "" }} class="p-2 rounded-lg transition-colors border border-transparent {{ $isOffline ? "text-gray-700 cursor-not-allowed" : "text-gray-400 hover:text-white hover:bg-gray-800 hover:border-gray-700" }}" title="Ping Device">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </button>
                            <button {{ $isOffline ? "disabled" : "" }} class="p-2 rounded-lg transition-colors border border-transparent {{ $isOffline ? "text-gray-700 cursor-not-allowed" : "text-gray-400 hover:text-emerald-400 hover:bg-emerald-500/10 hover:border-emerald-500/20" }}" title="Run Sign Check">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </button>
                            <button {{ $isOffline ? "disabled" : "" }} class="p-2 rounded-lg transition-colors border {{ $isOffline ? "text-gray-700 border-transparent cursor-not-allowed" : ($isBusy ? "text-orange-400 bg-orange-500/10 border-orange-500/30 hover:bg-orange-500/20" : "text-gray-400 border-transparent hover:text-orange-400 hover:bg-orange-500/10 hover:border-orange-500/20") }}" title="Restart Node">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center gap-3">

                            <div class="flex items-center gap-1 border-r border-gray-700/50 pr-3">
                                <button class="p-2 rounded-lg text-gray-500 hover:text-blue-400 hover:bg-blue-500/10 transition-colors" onclick="openEditModal('{{ $node->id }}', '{{ $node->name }}', '{{ $node->host_path }}', '{{ $node->is_primary }}')" title="Edit Node">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                </button>

                                <button class="p-2 rounded-lg text-gray-500 hover:text-red-500 hover:bg-red-500/10 transition-colors" onclick="openDeleteModal('{{ $node->id }}', '{{ $node->name }}')" title="Delete Node" type="button">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                </button>
                            </div>

                            @if ($isOffline)
                                <button class="p-2 rounded-lg text-emerald-400 bg-emerald-500/10 hover:bg-emerald-500/20 transition-colors border border-emerald-500/30 shadow-[0_0_10px_rgba(16,185,129,0.2)]" title="Power On">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                </button>
                            @else
                                <button class="p-2 rounded-lg text-gray-500 hover:text-red-500 hover:bg-red-500/10 transition-colors border border-transparent hover:border-red-500/30" title="Power Off">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-3 py-20 border-2 border-dashed border-gray-800 rounded-3xl flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4 text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 font-medium text-lg">No HSM Nodes Found</p>
                    <p class="text-gray-600 text-sm mt-1 max-w-sm">Register your HSM hardware nodes to start monitoring and managing them.</p>
                </div>
            @endforelse
        </div>

        <div class="bg-[#050505] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl mt-8">
            <div class="px-6 py-4 border-b border-gray-800 bg-[#0a0a0a] flex justify-between items-center">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Unified Cluster Logs <span class="text-[10px] text-gray-600 normal-case font-normal ml-2">(Live WebSockets)</span>
                </h3>
                <div class="flex gap-2">
                    <select class="bg-[#111] border border-gray-700 text-xs text-gray-400 rounded-lg px-2 py-1 outline-none focus:border-red-500">
                        <option>All Nodes</option>
                    </select>
                </div>
            </div>
            <div class="p-6 font-mono text-xs space-y-2 h-[400px] overflow-y-auto bg-black/80">
                <p class="text-gray-500 italic">Waiting for incoming serial logs...</p>
                <div class="animate-pulse inline-block w-2 h-4 bg-gray-500 ml-1"></div>
            </div>
        </div>

    </div>

    <div class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300" id="registerNodeModal">
        <div class="bg-[#111] border border-gray-800 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="registerNodeModalContent">
            <div class="p-8">
                <h3 class="text-xl font-bold text-white">Register HSM Node</h3>
                <p class="text-sm text-gray-500 mt-1">Register your HSM hardware node to the system.</p>

                <form action="{{ route("admin.hsm.store") }}" class="mt-8 space-y-6" method="POST">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Node Name</label>
                        <input class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 text-white focus:border-red-500 outline-none transition-all" name="name" placeholder="Example: NODE-01" required type="text">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">USB Host Path</label>
                        <input class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 text-white focus:border-red-500 outline-none transition-all font-mono text-sm" name="host_path" placeholder="Example: /dev/ttyUSB0" required type="text" value="/dev/ttyUSB0">
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button class="flex-1 px-4 py-3 rounded-xl border border-gray-800 text-gray-400 font-bold text-sm hover:bg-white/5 transition-all" onclick="closeModal('registerNodeModal')" type="button">
                            CANCEL
                        </button>
                        <button class="flex-1 px-4 py-3 rounded-xl bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition-all shadow-lg shadow-red-600/20" type="submit">
                            REGISTER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed bottom-6 right-6 transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-3 bg-[#111] border rounded-xl px-5 py-4 pointer-events-none shadow-2xl" id="toastNotification">
        <div id="toastIconWrapper"></div>
        <span class="text-sm font-medium text-white" id="toastMessage"></span>
    </div>

    <div class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300" id="editNodeModal">
        <div class="bg-[#111] border border-gray-800 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="editNodeModalContent">
            <div class="p-8">
                <h3 class="text-xl font-bold text-white">Edit HSM Node</h3>
                <p class="text-sm text-gray-500 mt-1">Update your HSM node configuration.</p>

                <form action="" class="mt-8 space-y-6" id="editNodeForm" method="POST">
                    @csrf
                    @method("PUT")
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Node Name</label>
                        <input class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-all" id="edit_name" name="name" required type="text">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">USB Host Path</label>
                        <input class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-all font-mono text-sm" id="edit_host_path" name="host_path" required type="text">
                    </div>

                    <div class="flex items-center gap-3">
                        <input class="w-4 h-4 text-blue-600 bg-black border-gray-800 rounded focus:ring-blue-500" id="edit_is_primary" name="is_primary" type="checkbox" value="1">
                        <label class="text-sm font-medium text-gray-400" for="edit_is_primary">Set as Primary Node</label>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button class="flex-1 px-4 py-3 rounded-xl border border-gray-800 text-gray-400 font-bold text-sm hover:bg-white/5 transition-all" onclick="closeModal('editNodeModal')" type="button">
                            CANCEL
                        </button>
                        <button class="flex-1 px-4 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20" type="submit">
                            UPDATE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300" id="deleteNodeModal">
        <div class="bg-[#111] border border-red-900/50 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="deleteNodeModalContent">
            <div class="p-8 text-center">
                <div class="w-16 h-16 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center mx-auto mb-5 border border-red-500/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-white mb-2">Delete HSM Node?</h3>
                <p class="text-sm text-gray-400">Are you sure you want to delete <span class="font-bold text-white uppercase px-2 py-0.5 bg-gray-800 rounded" id="delete_node_name"></span> permanently? This action cannot be undone.</p>

                <form action="" class="mt-8 flex gap-3" id="deleteNodeForm" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="flex-1 px-4 py-3 rounded-xl border border-gray-800 text-gray-400 font-bold text-sm hover:bg-white/5 transition-all" onclick="closeModal('deleteNodeModal')" type="button">
                        CANCEL
                    </button>
                    <button class="flex-1 px-4 py-3 rounded-xl bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition-all shadow-lg shadow-red-600/20" type="submit">
                        YES, DELETE
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            const content = document.getElementById(id + 'Content');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const content = document.getElementById(id + 'Content');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast('Command copied to clipboard!', 'success');
                }).catch(err => {
                    console.warn('Clipboard API failed, trying fallback...', err);
                    fallbackCopyTextToClipboard(text);
                });
            } else {
                fallbackCopyTextToClipboard(text);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                if (successful) {
                    showToast('Command copied to clipboard!', 'success');
                } else {
                    showToast('Failed to copy command.', 'error');
                }
            } catch (err) {
                console.error('Fallback copy gagal', err);
                showToast('Failed to copy command.', 'error');
            }
            document.body.removeChild(textArea);
        }

        let toastTimer;

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toastNotification');
            const messageEl = document.getElementById('toastMessage');
            const iconWrapper = document.getElementById('toastIconWrapper');

            messageEl.textContent = message;

            toast.className = "fixed bottom-6 right-6 transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-3 bg-[#111] border rounded-xl px-5 py-4 pointer-events-none shadow-2xl";

            if (type === 'success') {
                toast.classList.add('border-emerald-500/30', 'shadow-emerald-500/10');
                iconWrapper.innerHTML = `<svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>`;
            } else if (type === 'error') {
                toast.classList.add('border-red-500/30', 'shadow-red-500/10');
                iconWrapper.innerHTML = `<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`;
            }

            setTimeout(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
            }, 10);

            if (toastTimer) clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3500);
        }

        function openEditModal(id, name, path, isPrimary) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_host_path').value = path;
            document.getElementById('edit_is_primary').checked = (isPrimary == 1);
            document.getElementById('editNodeForm').action = `/admin/hsm/${id}`;
            openModal('editNodeModal');
        }

        function openDeleteModal(id, name) {
            document.getElementById('delete_node_name').textContent = name;
            document.getElementById('deleteNodeForm').action = `/admin/hsm/${id}`;
            openModal('deleteNodeModal');
        }

        document.addEventListener('DOMContentLoaded', () => {
            @if (session("success"))
                showToast("{!! addslashes(session("success")) !!}", 'success');
            @endif

            @if (session("error"))
                showToast("{!! addslashes(session("error")) !!}", 'error');
            @endif

            @if ($errors->any())
                showToast("{!! addslashes($errors->first()) !!}", 'error');
            @endif
        });
    </script>
</x-layouts.admin>
