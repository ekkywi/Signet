<x-layouts.app title="Dashboard - Signet">

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
                    <h2 class="text-2xl font-bold text-white tracking-tight">
                        Welcome back, {{ explode(" ", trim($user->name))[0] }}.
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Here's what's happening in your workspace today.</p>
                </div>
                <button class="flex items-center gap-2 bg-teal-600 hover:bg-teal-500 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-teal-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Generate License
                </button>
            </div>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-teal-500/10 rounded-full blur-2xl transition-all group-hover:bg-teal-500/20"></div>
                <p class="text-sm font-medium text-gray-400 relative z-10">Active Licenses</p>
                <p class="text-3xl font-bold text-white mt-2 relative z-10">{{ $stats["active_licenses"] ?? 0 }}</p>
            </div>

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl transition-all group-hover:bg-blue-500/20"></div>
                <p class="text-sm font-medium text-gray-400 relative z-10">Active API Keys</p>
                <p class="text-3xl font-bold text-white mt-2 relative z-10">{{ $stats["total_api_keys"] ?? 0 }}</p>
            </div>

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-red-500/10 rounded-full blur-2xl transition-all group-hover:bg-red-500/20"></div>
                <p class="text-sm font-medium text-gray-400 relative z-10">Revoked Licenses</p>
                <p class="text-3xl font-bold text-white mt-2 relative z-10">{{ $stats["revoked_licenses"] ?? 0 }}</p>
            </div>

        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="px-6 py-5 border-b border-gray-800">
                <h3 class="text-base font-semibold text-white">Recent Licenses</h3>
            </div>
            <div class="flex flex-col items-center justify-center text-gray-500 py-16">
                <svg class="w-12 h-12 mb-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                </svg>
                <p class="text-base font-medium text-gray-400 mb-1">No licenses generated yet</p>
                <p class="text-sm">When you create licenses for your products, they will appear here.</p>
            </div>
        </div>

    </div>

</x-layouts.app>
