<!DOCTYPE html>
<html class="h-full bg-[#0a0a0a]" lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? "Signet Console" }}</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="h-full text-gray-300 font-sans antialiased overflow-hidden flex">

    <x-sidebar />

    <main class="flex-1 overflow-y-auto bg-[#0a0a0a]">
        {{ $slot }}
    </main>

</body>

</html>
