<!DOCTYPE html>
<html class="h-full bg-[#030303]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Dashboard | Signet Console</title>

    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
</head>

<body class="h-full text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300 flex overflow-hidden" style="font-family: 'Poppins', sans-serif;">

    <aside class="w-64 bg-[#0A0A0A] border-r border-gray-800 flex flex-col justify-between hidden md:flex shrink-0">
        <div>
            <div class="h-16 flex items-center px-6 border-b border-gray-800/60">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 border border-gray-700 bg-[#111] rounded-lg flex items-center justify-center shadow-lg shadow-teal-900/20">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight text-white">Signet</span>
                </div>
            </div>

            <nav class="p-4 space-y-1">
                <a class="flex items-center gap-3 px-3 py-2.5 bg-gray-800/50 text-white rounded-xl font-medium text-sm transition-colors border border-gray-700/50" href="#">
                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Overview
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-xl font-medium text-sm transition-colors" href="#">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Products
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-xl font-medium text-sm transition-colors" href="#">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    Licenses
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-xl font-medium text-sm transition-colors" href="#">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    API Keys
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-800/60">
            <a class="flex items-center gap-3 px-3 py-2.5 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-xl font-medium text-sm transition-colors" href="#">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                Settings
            </a>
            <div class="mt-4 flex items-center gap-3 px-3 py-2 border border-gray-800 bg-[#111] rounded-xl">
                <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center text-xs font-bold text-white">JD</div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs font-medium text-white truncate">John Developer</p>
                    <p class="text-[10px] text-gray-500 truncate">Free Plan</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full relative overflow-y-auto">
        <div class="absolute top-0 right-0 w-[400px] h-[300px] bg-teal-600/5 blur-[100px] rounded-full pointer-events-none -z-10"></div>

        <header class="h-16 flex items-center justify-between px-8 border-b border-gray-800/60 sticky top-0 bg-[#030303]/80 backdrop-blur-md z-10">
            <h1 class="text-lg font-semibold text-white">Overview</h1>

            <button class="flex items-center gap-2 bg-teal-600 hover:bg-teal-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all shadow-lg shadow-teal-500/20 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                Generate License
            </button>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full space-y-8">

            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Welcome back, John.</h2>
                <p class="text-sm text-gray-400 mt-1">Here is the state of your software licenses today.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl p-6 shadow-lg shadow-black/20">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-400">Total Active Licenses</h3>
                        <div class="w-8 h-8 bg-teal-500/10 rounded-lg flex items-center justify-center border border-teal-500/20">
                            <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white">1,248</p>
                    <p class="text-xs text-emerald-400 mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M5 10l7-7m0 0l7 7m-7-7v18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        12% from last month
                    </p>
                </div>

                <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl p-6 shadow-lg shadow-black/20">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-400">API Validations (30d)</h3>
                        <div class="w-8 h-8 bg-purple-500/10 rounded-lg flex items-center justify-center border border-purple-500/20">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white">45.2K</p>
                    <p class="text-xs text-gray-500 mt-2">All requests secured via Micro HSM</p>
                </div>

                <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl p-6 shadow-lg shadow-black/20">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-400">Revoked / Suspended</h3>
                        <div class="w-8 h-8 bg-red-500/10 rounded-lg flex items-center justify-center border border-red-500/20">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white">24</p>
                    <p class="text-xs text-red-400 mt-2 flex items-center gap-1">
                        Node-Lock violations detected
                    </p>
                </div>
            </div>

            <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl shadow-lg shadow-black/20 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-800 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-white">Recently Generated Licenses</h3>
                    <a class="text-sm font-medium text-teal-500 hover:text-teal-400" href="#">View all</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b border-gray-800 bg-[#111] text-gray-500 text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-4">Serial Key</th>
                                <th class="px-6 py-4">Product</th>
                                <th class="px-6 py-4">Node-Lock</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/60">
                            <tr class="hover:bg-gray-800/20 transition-colors">
                                <td class="px-6 py-4 font-mono text-gray-300">SGNT-8X2A-PL9Q</td>
                                <td class="px-6 py-4 text-gray-400">Signet Desktop Pro</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                        <div class="w-1.5 h-1.5 rounded-full bg-purple-500"></div> Enforced
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium bg-teal-500/10 text-teal-400 border border-teal-500/20">
                                        <div class="w-1.5 h-1.5 rounded-full bg-teal-500"></div> Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-gray-500">2 mins ago</td>
                            </tr>

                            <tr class="hover:bg-gray-800/20 transition-colors">
                                <td class="px-6 py-4 font-mono text-gray-300">SGNT-M4C1-Z2X9</td>
                                <td class="px-6 py-4 text-gray-400">API Gateway Lite</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium bg-gray-800 text-gray-400 border border-gray-700">
                                        Disabled
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium bg-teal-500/10 text-teal-400 border border-teal-500/20">
                                        <div class="w-1.5 h-1.5 rounded-full bg-teal-500"></div> Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-gray-500">1 hour ago</td>
                            </tr>

                            <tr class="hover:bg-gray-800/20 transition-colors">
                                <td class="px-6 py-4 font-mono text-gray-500 line-through">SGNT-P9L0-K3M8</td>
                                <td class="px-6 py-4 text-gray-500">Signet Desktop Pro</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                        <div class="w-1.5 h-1.5 rounded-full bg-purple-500"></div> Enforced
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                                        <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div> Revoked
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-gray-500">Yesterday</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>

</html>
