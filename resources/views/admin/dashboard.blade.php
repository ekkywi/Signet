<x-layouts.admin title="Signet | Control Room">

    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">System Overview</h2>
            <p class="text-sm text-gray-500 mt-1">Global metrics and hardware status for Signet KMS.</p>
        </div>
    </div>

    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">

        @if (session("success"))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-6 py-4 rounded-xl flex items-center gap-3 shadow-lg shadow-red-500/10 animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span class="font-medium text-sm">{{ session("success") }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Workspaces</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalWorkspaces }}</h3>
                <div class="mt-4 flex items-center text-xs text-red-400 font-medium">
                    <a class="hover:underline flex items-center gap-1" href="{{ route("admin.workspaces.index") }}">Manage Workspaces<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg></a>
                </div>
            </div>

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Registered Users</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalUsers }}</h3>
                <div class="mt-4 flex items-center text-xs text-orange-400 font-medium">
                    <a class="hover:underline flex items-center gap-1" href="#">View User List <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg></a>
                </div>
            </div>

            <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Global Licenses Issued</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalLicenses }}</h3>
                <div class="mt-4 flex items-center text-xs text-amber-400 font-medium">
                    <span class="flex items-center gap-1">Across all tenants</span>
                </div>
            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl mt-8">
            <div class="px-6 py-5 border-b border-gray-800 bg-[#0a0a0a] flex justify-between items-center">
                <div>
                    <h3 class="text-base font-semibold text-white flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        HSM Hardware Status
                    </h3>
                    <p class="text-sm text-gray-500 mt-0.5">Connection logs and cryptographic operations.</p>
                </div>
                <button class="text-xs bg-gray-800/50 hover:bg-gray-800 text-gray-300 px-3 py-1.5 rounded-lg border border-gray-700/50 transition-colors">
                    Ping Device
                </button>
            </div>

            <div class="p-12 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-emerald-500/10 rounded-full flex items-center justify-center mb-4 border border-emerald-500/20">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                    </svg>
                </div>
                <h4 class="text-white font-medium">ESP32 HSM Bridge Active</h4>
                <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">The Node.js bridge is currently listening for signing requests. Serial port communication is stable.</p>
            </div>
        </div>

    </div>
</x-layouts.admin>
