<x-layouts.app title="Dashboard - Signet">

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">Welcome back, {{ explode(" ", $user->name)[0] }}</h2>
            <p class="text-sm text-gray-500 mt-1">Here is the overview of your {{ $workspace->name }} workspace.</p>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        @if (session("success"))
            <div class="bg-teal-500/10 border border-teal-500/50 text-teal-400 px-6 py-4 rounded-xl flex items-center gap-3 shadow-lg shadow-teal-500/10 animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span class="font-medium text-sm">{{ session("success") }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Products</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalProducts }}</h3>
                <div class="mt-4 flex items-center text-xs text-teal-400 font-medium">
                    <a class="hover:underline flex items-center gap-1" href="{{ route("products.index") }}">Manage Products <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg></a>
                </div>
            </div>

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Issued Licenses</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalLicenses }}</h3>
                <div class="mt-4 flex items-center text-xs text-blue-400 font-medium">
                    <a class="hover:underline flex items-center gap-1" href="{{ route("licenses.index") }}">View Licenses <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg></a>
                </div>
            </div>

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Active Devices</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalDevices }}</h3>
                <div class="mt-4 flex items-center text-xs text-purple-400 font-medium">
                    <span class="flex items-center gap-1">Connected globally</span>
                </div>
            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl mt-8">
            <div class="px-6 py-5 border-b border-gray-800 bg-[#0a0a0a]">
                <h3 class="text-base font-semibold text-white">Recent Device Activations</h3>
                <p class="text-sm text-gray-500 mt-0.5">The latest devices that successfully authenticated via API.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Device / Hardware ID</th>
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">License Snippet</th>
                            <th class="px-6 py-4 text-right">Last Ping</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($recentActivations as $activation)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-white font-medium">{{ $activation->device_name }}</p>
                                    <p class="text-xs text-gray-500 mt-1 font-mono">{{ $activation->hardware_identifier }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-gray-800/50 text-gray-300 text-xs font-medium border border-gray-700/50">
                                        {{ $activation->license->product->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="text-teal-400 font-mono text-xs">{{ substr($activation->license->key, 0, 9) }}...</code>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-xs text-gray-400">{{ $activation->last_active_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-12 text-center text-gray-500" colspan="4">
                                    No devices have connected yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
