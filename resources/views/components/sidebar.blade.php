@php
    $user = auth()->user();
    $workspace = $user ? $user->workspaces()->first() : null;
@endphp

<aside class="w-64 bg-[#111] border-r border-gray-800 flex flex-col justify-between hidden md:flex">
    <div class="overflow-y-auto overflow-x-hidden no-scrollbar">
        <div class="h-16 flex items-center px-6 border-b border-gray-800 shrink-0 sticky top-0 bg-[#111] z-10">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center ring-1 ring-teal-500/50">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <span class="text-white font-bold text-lg tracking-tight">Signet<span class="text-teal-500">.</span></span>
            </div>
        </div>

        <nav class="p-4 space-y-6">

            <div class="space-y-1">
                <p class="px-3 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Core System</p>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("dashboard") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("dashboard") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Dashboard
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("products.*") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("products.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Products
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("licenses.*") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("licenses.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Licenses
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("offline-licenses.*") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("offline-licenses.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Offline Generator
                </a>
            </div>

            <div class="space-y-1">
                <p class="px-3 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Access & Security</p>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("apikeys.*") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("apikeys.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    API & Credentials
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs("logs.*") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("logs.index") }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Audit Logs
                </a>
            </div>

            <div class="pt-2">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs("docs") ? "bg-teal-500/10 text-teal-400 border border-teal-500/20" : "text-gray-400 hover:text-white hover:bg-[#111] hover:border hover:border-gray-800 border border-transparent" }}" href="{{ route("docs") }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <span class="font-medium text-sm">Dev Documentation</span>
                </a>
            </div>

        </nav>
    </div>

    <div class="p-4 border-t border-gray-800 bg-[#111]">
        @if ($user)
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center text-xs font-bold text-white uppercase">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs font-medium text-white truncate">{{ $user->name }}</p>
                    <p class="text-[10px] text-gray-500 truncate">{{ $workspace->name ?? "Default Workspace" }}</p>
                </div>
            </div>

            <a class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium transition-colors {{ request()->routeIs("profile.edit") ? "bg-teal-500/10 text-teal-400" : "text-gray-400 hover:text-white hover:bg-white/5" }}" href="{{ route("profile.edit") }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                Account Settings
            </a>

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
