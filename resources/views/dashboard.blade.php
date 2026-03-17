<x-layouts.app title="Dashboard - Signet">

    @if (session("success"))
        <div class="bg-teal-500/10 border border-teal-500/50 text-teal-400 px-6 py-4 mx-8 mt-8 rounded-xl flex items-center gap-3 shadow-lg shadow-teal-500/10 animate-fade-in-down">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <span class="font-medium text-sm">{{ session("success") }}</span>
        </div>
    @endif

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
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

    <div class="p-8 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6">
                <p class="text-sm font-medium text-gray-400">Active Licenses</p>
                <p class="text-3xl font-bold text-white mt-2">{{ $stats["active_licenses"] ?? 0 }}</p>
            </div>
        </div>

    </div>

</x-layouts.app>
