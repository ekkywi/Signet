<x-layouts.admin title="Signet | Workspace Management">
    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Workspaces</h2>
                <p class="text-sm text-gray-500 mt-1">Manage tenant organizations, resource limits, and subscriptions.</p>
            </div>
        </div>
    </div>

    <div class="p-8 space-y-6 max-w-7xl mx-auto w-full">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Workspaces</p>
                <div class="flex items-end gap-2 mt-2">
                    <h3 class="text-3xl font-bold text-white leading-none">12</h3>
                    <span class="text-xs text-emerald-400 font-medium mb-1">+2 this week</span>
                </div>
            </div>
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Active Nodes</p>
                <div class="flex items-end gap-2 mt-2">
                    <h3 class="text-3xl font-bold text-white leading-none">45</h3>
                    <span class="text-xs text-gray-500 font-medium mb-1">/ 50 capacity</span>
                </div>
            </div>
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Global API Load</p>
                <div class="flex items-end gap-2 mt-2">
                    <h3 class="text-3xl font-bold text-white leading-none">2.4M</h3>
                    <span class="text-xs text-emerald-400 font-medium mb-1">req/mo</span>
                </div>
            </div>
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Suspended</p>
                <div class="flex items-end gap-2 mt-2">
                    <h3 class="text-3xl font-bold text-red-500 leading-none">1</h3>
                    <span class="text-xs text-gray-500 font-medium mb-1">action required</span>
                </div>
            </div>
        </div>

        <div class="bg-[#050505] border border-gray-800 rounded-3xl overflow-hidden shadow-2xl">
            <div class="px-6 py-4 border-b border-gray-800 bg-[#0a0a0a] flex justify-between items-center">
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <input class="bg-[#111] border border-gray-800 text-sm text-white rounded-xl pl-10 pr-4 py-2 outline-none focus:border-gray-600 w-64 transition-all" placeholder="Search workspaces..." type="text">
                </div>
                <div class="flex gap-2">
                    <select class="bg-[#111] border border-gray-800 text-sm text-gray-400 rounded-xl px-4 py-2 outline-none focus:border-gray-600">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Suspended</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#0a0a0a] border-b border-gray-800/50 text-[10px] uppercase tracking-widest text-gray-500">
                            <th class="px-6 py-4 font-bold">Organization</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Owner</th>
                            <th class="px-6 py-4 font-bold">Assets (Prod/Lic)</th>
                            <th class="px-6 py-4 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-800/50">
                        @forelse($workspaces as $workspace)
                            @php
                                $isActive = $workspace->status === "active";
                                $statusColor = $isActive ? "text-emerald-400 bg-emerald-500/10 border-emerald-500/20" : "text-red-500 bg-red-500/10 border-red-500/20";

                                // Membuat inisial 2 huruf dari nama workspace
                                $initials = strtoupper(substr($workspace->name, 0, 2));

                                // Menghitung total produk dan lisensi dari relasi
                                $totalProducts = $workspace->products->count();
                                $totalLicenses = $workspace->licenses->count();
                            @endphp

                            <tr class="hover:bg-white/[0.02] transition-colors group {{ !$isActive ? "opacity-75" : "" }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-inner">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <p class="text-white font-bold">{{ $workspace->name }}</p>
                                            <p class="text-xs text-gray-500 font-mono mt-0.5" title="{{ $workspace->id }}">
                                                wrk_{{ substr($workspace->id, 0, 8) }}...
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="{{ $statusColor }} text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider border">
                                        {{ $workspace->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-gray-300 font-medium">{{ $workspace->user->name ?? "Unknown Owner" }}</span>
                                        <span class="text-xs text-gray-500">{{ $workspace->user->email ?? "" }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_5px_rgba(59,130,246,0.5)]"></span>
                                            <span class="text-white font-mono text-xs">{{ $totalProducts }} Products</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-orange-500 shadow-[0_0_5px_rgba(249,115,22,0.5)]"></span>
                                            <span class="text-white font-mono text-xs">{{ $totalLicenses }} Licenses</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a class="p-2 text-gray-500 hover:text-emerald-400 hover:bg-gray-800 rounded-lg transition-colors" href="{{ route("admin.impersonate", $workspace->user->id) }}" title="Login as {{ $workspace->user->name }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                            </svg>
                                        </a>

                                        <button class="p-2 text-gray-500 hover:text-white hover:bg-gray-800 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-12 text-center" colspan="5">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4 text-gray-500">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 font-medium text-lg">No Workspaces Found</p>
                                        <p class="text-gray-600 text-sm mt-1">There are no tenant organizations registered in the system yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-800 bg-[#0a0a0a]">
                {{ $workspaces->links() }}
            </div>

        </div>
    </div>
</x-layouts.admin>
