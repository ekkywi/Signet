<!DOCTYPE html>
<html class="h-full bg-[#030303]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Sign In | Signet Console</title>

    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
</head>

<body class="h-full flex items-center justify-center text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300 relative" style="font-family: 'Poppins', sans-serif;">

    <div class="fixed inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,#151515_1px,transparent_1px),linear-gradient(to_bottom,#151515_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-teal-600/10 blur-[100px] rounded-full pointer-events-none -z-10"></div>

    <div class="w-full max-w-md px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm flex flex-col items-center">
            <a class="w-12 h-12 border border-gray-700 bg-[#111] rounded-xl flex items-center justify-center shadow-lg hover:border-teal-500/50 transition-colors duration-300 relative overflow-hidden group" href="/">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-600/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <svg class="w-6 h-6 text-teal-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </a>
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-white">Welcome back</h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Log in to manage your workspaces and keys.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="bg-[#0A0A0A]/80 backdrop-blur-xl border border-gray-800 py-8 px-6 shadow-2xl shadow-black/50 rounded-3xl relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-white/[0.02] to-transparent pointer-events-none"></div>

                <form action="/login" class="space-y-6 relative z-10" method="POST">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-300" for="email">Email address</label>
                        <div class="mt-2">
                            <input autocomplete="email" class="block w-full rounded-xl border-0 bg-[#111] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm sm:leading-6 transition-all duration-300" id="email" name="email" placeholder="admin@trezanix.com" required type="email">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium leading-6 text-gray-300" for="password">Password</label>
                            <div class="text-sm">
                                <a class="font-medium text-teal-500 hover:text-teal-400 transition-colors" href="#">Forgot password?</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input autocomplete="current-password" class="block w-full rounded-xl border-0 bg-[#111] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm sm:leading-6 transition-all duration-300" id="password" name="password" placeholder="••••••••" required type="password">
                        </div>
                    </div>

                    <div>
                        <button class="flex w-full justify-center rounded-xl bg-teal-600 px-3 py-3.5 text-sm font-semibold leading-6 text-white shadow-lg shadow-teal-500/20 hover:bg-teal-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600 transition-all duration-300 active:scale-[0.98]" type="submit">
                            Sign in to Console
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500 relative z-10">
                    Not a member?
                    <a class="font-semibold leading-6 text-teal-500 hover:text-teal-400 transition-colors" href="/register">Create a free account</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
