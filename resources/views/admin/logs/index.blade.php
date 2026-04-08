<x-layouts.admin title="Signet | Global Audit Logs">
    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">Global Audit Logs</h2>
            <p class="text-sm text-gray-500 mt-1">Full traceability of every system action and API call.</p>
        </div>
    </div>

    <div class="p-8 max-w-7xl mx-auto w-full">
        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-bold text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Timestamp</th>
                            <th class="px-6 py-4">User / Actor</th>
                            <th class="px-6 py-4">Event</th>
                            <th class="px-6 py-4">Target Workspace</th>
                            <th class="px-6 py-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs">2026-04-08 14:30:12</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gray-800 flex items-center justify-center text-[10px] text-white">JD</div>
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-medium">LICENSE_ISSUED</span>
                            </td>
                            <td class="px-6 py-4 text-xs">JD Corp Workspace</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase">Success</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs">2026-04-08 14:35:45</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                    <span>External API</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-medium">CRYPTO_SIGN_FAILED</span>
                            </td>
                            <td class="px-6 py-4 text-xs">Dev-Test Workspace</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20 uppercase">Failed</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-[#0a0a0a] border-t border-gray-800">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-500 font-medium">Showing 1 to 20 of 1,240 entries</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 rounded bg-gray-800 text-xs text-gray-400">Previous</button>
                        <button class="px-3 py-1 rounded bg-red-500/20 text-xs text-red-400 border border-red-500/30">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
