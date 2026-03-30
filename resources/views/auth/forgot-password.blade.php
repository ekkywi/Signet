<!DOCTYPE html>
<html class="h-full bg-[#030303]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Signet | Forgot Password</title>

    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
</head>

<body class="h-full flex items-center justify-center text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300 relative" style="font-family: 'Poppins', sans-serif;">

    <div class="fixed inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,#151515_1px,transparent_1px),linear-gradient(to_bottom,#151515_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-cyan-600/10 blur-[100px] rounded-full pointer-events-none -z-10"></div>

    <div class="w-full max-w-md px-6 lg:px-8 py-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm flex flex-col items-center">
            <a class="w-12 h-12 border border-gray-700 bg-[#111] rounded-xl flex items-center justify-center shadow-lg hover:border-cyan-500/50 transition-colors duration-300 relative overflow-hidden group" href="/">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-600/20 to-blue-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <svg class="w-6 h-6 text-cyan-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </a>
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-white">Reset Password</h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Enter your email address and we'll send you a link to reset your password.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="bg-[#0A0A0A]/80 backdrop-blur-xl border border-gray-800 py-8 px-6 shadow-2xl shadow-black/50 rounded-3xl relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-white/[0.02] to-transparent pointer-events-none"></div>

                @if (session("status"))
                    <div class="mb-6 rounded-xl bg-cyan-500/10 border border-cyan-500/50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" fill-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-cyan-400">{{ session("status") }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @error("email")
                    <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" fill-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-400">{{ $message }}</p>
                            </div>
                        </div>
                    </div>
                @enderror

                <form action="/forgot-password" class="space-y-6 relative z-10" method="POST">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-300" for="email">Email address</label>
                        <div class="mt-2">
                            <input autocomplete="email" class="block w-full rounded-xl border-0 bg-[#111] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-cyan-500 sm:text-sm sm:leading-6 transition-all duration-300" id="email" name="email" placeholder="developer@example.com" required type="email">
                        </div>
                    </div>

                    <div>
                        <button class="flex w-full justify-center rounded-xl bg-cyan-600 px-3 py-3.5 text-sm font-semibold leading-6 text-white shadow-lg shadow-cyan-500/20 hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600 transition-all duration-300 active:scale-[0.98]" type="submit">
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <div class="mt-8 flex items-center justify-center relative z-10">
                    <a class="flex items-center gap-2 text-sm font-medium text-gray-400 hover:text-white transition-colors" href="/login">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        Back to log in
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
