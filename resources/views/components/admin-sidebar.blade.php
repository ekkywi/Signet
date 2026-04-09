@php
    $user = auth()->user();
@endphp

<aside class="w-64 bg-[#111] border-r border-gray-800 flex flex-col justify-between hidden md:flex">
    <div class="overflow-y-auto overflow-x-hidden no-scrollbar">
        <div class="h-16 flex items-center px-6 border-b border-gray-800 shrink-0 sticky top-0 bg-[#111] z-10">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center ring-1 ring-red-500/50">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <span class="text-white font-bold text-lg tracking-tight">Signet<span class="text-red-500">.</span></span>
            </div>
        </div>

        <nav class="p-4 space-y-6">

            <div class="space-y-1">
                <p class="px-3 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Control Room</p>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("admin.dashboard") ? "bg-red-500/10 text-red-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("admin.dashboard") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Overview
                </a>
            </div>

            <div class="space-y-1">
                <p class="px-3 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">SaaS Management</p>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors text-gray-400 hover:text-white hover:bg-white/5" href="#">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Workspaces
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors text-gray-400 hover:text-white hover:bg-white/5" href="#">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Users
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors text-gray-400 hover:text-white hover:bg-white/5" href="#">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Subscriptions
                </a>
            </div>

            <div class="space-y-1">
                <p class="px-3 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-4">Hardware & Security</p>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("admin.hsm.*") ? "bg-red-500/10 text-red-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("admin.hsm.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    HSM
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("admin.logs.*") ? "bg-red-500/10 text-red-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("admin.logs.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Global Audit Logs
                </a>
            </div>

        </nav>
    </div>

    <div class="p-4 border-t border-gray-800 bg-[#111]">
        @if ($user)
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-xs font-bold text-white uppercase">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs font-medium text-white truncate">{{ $user->name }}</p>
                    <p class="text-[10px] text-red-500 font-bold tracking-wide truncate uppercase">Super Admin Access</p>
                </div>
            </div>

            <form action="{{ route("logout") }}" class="mt-1" method="POST">
                @csrf
                <button class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-gray-400 hover:text-red-400 hover:bg-red-500/10 text-xs font-medium transition-colors" type="submit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Sign Out
                </button>
            </form>
        @endif
    </div>
</aside>
