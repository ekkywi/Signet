<!DOCTYPE html>
<html class="h-full bg-[#0a0a0a]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? "Signet Console" }}</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="h-full text-gray-300 font-sans antialiased overflow-hidden flex">

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

</body>

</html>
