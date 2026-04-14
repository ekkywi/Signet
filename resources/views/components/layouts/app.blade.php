<!DOCTYPE html>
<html class="h-full bg-[#0a0a0a]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? "Signet Console" }}</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="h-full text-gray-300 font-sans antialiased overflow-hidden flex flex-col">

    @if (session()->has("impersonate_admin_id"))
        <div class="bg-gradient-to-r from-red-600 to-orange-600 text-white py-2 px-4 shadow-2xl relative z-[9999] flex-shrink-0">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm font-bold">
                    <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" fill-rule="evenodd"></path>
                    </svg>
                    IMPERSONATION MODE: You are viewing the screen as {{ auth()->user()->name }}
                </div>
                <a class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg text-xs font-bold transition-colors border border-white/30" href="{{ route("admin.impersonate.leave") }}">
                    Return to Admin Mode
                </a>
            </div>
        </div>
    @endif

    <div class="flex-1 flex overflow-hidden">

        <x-sidebar />

        <main class="flex-1 overflow-y-auto bg-[#0a0a0a] flex flex-col">
            <div class="flex-1">
                {{ $slot }}
            </div>

            <footer class="py-4 px-8 border-t border-gray-800/50 mt-auto">
                <div class="flex items-center justify-between text-xs text-gray-500 font-medium">
                    <span>&copy; {{ date("Y") }} Trezanix. All rights reserved.</span>
                    <span class="font-mono text-[10px] font-bold tracking-widest text-teal-400 bg-teal-500/10 px-2 py-0.5 rounded border border-teal-500/20">
                        v{{ config("app.version", "1.0.0") }}
                    </span>
                </div>
            </footer>
        </main>

    </div>

</body>

</html>
