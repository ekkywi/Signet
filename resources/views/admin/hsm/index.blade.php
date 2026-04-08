<x-layouts.admin title="Signet | HSM Cluster Status">
    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="bg-red-500/10 text-red-400 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider border border-red-500/20">Cluster View</span>
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">HSM Hardware Status</h2>
                <p class="text-sm text-gray-500 mt-1">Manage and monitor multiple ESP32 security nodes.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-red-600 hover:bg-red-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Register New Node
                </button>
            </div>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-[#111] border border-gray-800 rounded-2xl shadow-xl relative overflow-hidden transition-all hover:border-gray-700 flex flex-col">
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h4 class="text-white font-bold text-lg flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                                NODE-01
                            </h4>
                            <p class="text-xs text-gray-500 font-mono mt-1">/dev/ttyUSB0 • Primary</p>
                        </div>
                        <span class="bg-emerald-500/10 text-emerald-400 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider border border-emerald-500/20">Online</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Ping</p>
                            <p class="text-xl font-mono font-bold text-white">12<span class="text-xs text-gray-500 ml-1">ms</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Queue</p>
                            <p class="text-xl font-mono font-bold text-white">0<span class="text-xs text-gray-500 ml-1">req</span></p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800/60 bg-black/40 px-4 py-3 flex items-center justify-between">
                    <div class="flex gap-2">
                        <button class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-700" title="Ping Device">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-gray-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-colors border border-transparent hover:border-emerald-500/20" title="Run Sign Check">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-gray-400 hover:text-orange-400 hover:bg-orange-500/10 transition-colors border border-transparent hover:border-orange-500/20" title="Restart Node">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                    </div>
                    <button class="p-2 rounded-lg text-gray-500 hover:text-red-500 hover:bg-red-500/10 transition-colors border border-transparent hover:border-red-500/30" title="Power Off">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="bg-[#111] border border-orange-900/30 rounded-2xl shadow-xl relative overflow-hidden transition-all hover:border-orange-700/50 flex flex-col">
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h4 class="text-white font-bold text-lg flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                                NODE-02
                            </h4>
                            <p class="text-xs text-gray-500 font-mono mt-1">/dev/ttyUSB1 • Worker</p>
                        </div>
                        <span class="bg-orange-500/10 text-orange-400 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider border border-orange-500/20">Busy</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Ping</p>
                            <p class="text-xl font-mono font-bold text-orange-400">85<span class="text-xs text-gray-500 ml-1">ms</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Queue</p>
                            <p class="text-xl font-mono font-bold text-orange-400">14<span class="text-xs text-gray-500 ml-1">req</span></p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-orange-900/30 bg-black/40 px-4 py-3 flex items-center justify-between">
                    <div class="flex gap-2">
                        <button class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-700" title="Ping Device">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-gray-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-colors border border-transparent hover:border-emerald-500/20" title="Run Sign Check">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-orange-400 bg-orange-500/10 hover:bg-orange-500/20 transition-colors border border-orange-500/30" title="Restart Node">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                    </div>
                    <button class="p-2 rounded-lg text-gray-500 hover:text-red-500 hover:bg-red-500/10 transition-colors border border-transparent hover:border-red-500/30" title="Power Off">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="bg-[#0a0a0a] border border-red-900/50 rounded-2xl shadow-xl relative overflow-hidden transition-all opacity-75 flex flex-col">
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h4 class="text-gray-400 font-bold text-lg flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                                NODE-03
                            </h4>
                            <p class="text-xs text-red-500/70 font-mono mt-1">192.168.1.150 • Remote</p>
                        </div>
                        <span class="bg-red-500/10 text-red-500 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider border border-red-500/20">Offline</span>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2 text-center">
                        <p class="text-xs text-red-400">Connection Lost</p>
                        <p class="text-[10px] text-gray-600 mt-1">Hardware inaccessible</p>
                    </div>
                </div>
                <div class="border-t border-red-900/30 bg-black/40 px-4 py-3 flex items-center justify-between">
                    <div class="flex gap-2">
                        <button class="p-2 rounded-lg text-gray-700 cursor-not-allowed" disabled title="Ping Device (Disabled)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-gray-700 cursor-not-allowed" disabled title="Run Sign Check (Disabled)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-gray-700 cursor-not-allowed" disabled title="Restart Node (Disabled)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>
                    </div>
                    <button class="p-2 rounded-lg text-emerald-400 bg-emerald-500/10 hover:bg-emerald-500/20 transition-colors border border-emerald-500/30 shadow-[0_0_10px_rgba(16,185,129,0.2)]" title="Power On">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg> </button>
                </div>
            </div>

        </div>

        <div class="bg-[#050505] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl mt-8">
            <div class="px-6 py-4 border-b border-gray-800 bg-[#0a0a0a] flex justify-between items-center">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Unified Cluster Logs
                </h3>
                <div class="flex gap-2">
                    <select class="bg-[#111] border border-gray-700 text-xs text-gray-400 rounded-lg px-2 py-1 outline-none focus:border-red-500">
                        <option>All Nodes</option>
                        <option>NODE-01 Only</option>
                        <option>NODE-02 Only</option>
                    </select>
                </div>
            </div>
            <div class="p-6 font-mono text-xs space-y-2 h-[400px] overflow-y-auto bg-black/80">
                <p class="text-gray-500"><span class="text-gray-600 mr-2">[14:20:01]</span> <span class="text-blue-400 bg-blue-500/10 px-1 rounded mr-2">NODE-01</span> <span class="text-purple-400">HSM:</span> Executing AES-GCM-256 Decrypt...</p>
                <p class="text-gray-500"><span class="text-gray-600 mr-2">[14:20:01]</span> <span class="text-blue-400 bg-blue-500/10 px-1 rounded mr-2">NODE-01</span> <span class="text-emerald-400">SEND:</span> Signature generated successfully.</p>

                <p class="text-gray-500"><span class="text-gray-600 mr-2">[14:21:15]</span> <span class="text-orange-400 bg-orange-500/10 px-1 rounded mr-2">NODE-02</span> <span class="text-blue-400">RECV:</span> Auth Request from Workspace ID: 9b2f...</p>
                <p class="text-gray-500"><span class="text-gray-600 mr-2">[14:21:18]</span> <span class="text-orange-400 bg-orange-500/10 px-1 rounded mr-2">NODE-02</span> <span class="text-orange-400">WARN:</span> Execution delay detected (85ms).</p>

                <p class="text-gray-500"><span class="text-gray-600 mr-2">[14:25:10]</span> <span class="text-red-400 bg-red-500/10 px-1 rounded mr-2">NODE-03</span> <span class="text-red-500">ERR:</span> Heartbeat timeout. Retrying connection (3/5)...</p>

                <p class="text-gray-500"><span class="text-gray-600 mr-2">[14:25:12]</span> <span class="text-blue-400 bg-blue-500/10 px-1 rounded mr-2">NODE-01</span> <span class="text-gray-400">KEEP:</span> Heartbeat ACK from ESP32.</p>
                <div class="animate-pulse inline-block w-2 h-4 bg-gray-500 ml-1"></div>
            </div>
        </div>

    </div>
</x-layouts.admin>
