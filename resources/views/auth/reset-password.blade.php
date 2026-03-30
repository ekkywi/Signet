<!DOCTYPE html>
<html class="h-full bg-[#030303]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Signet | Reset Password</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
</head>

<body class="h-full flex items-center justify-center text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300 relative" style="font-family: 'Poppins', sans-serif;">

    <div class="fixed inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,#151515_1px,transparent_1px),linear-gradient(to_bottom,#151515_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-cyan-600/10 blur-[100px] rounded-full pointer-events-none -z-10"></div>

    <div class="w-full max-w-md px-6 lg:px-8 py-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm flex flex-col items-center">
            <div class="w-12 h-12 border border-gray-700 bg-[#111] rounded-xl flex items-center justify-center shadow-lg relative overflow-hidden group">
                <svg class="w-6 h-6 text-cyan-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-white">Create New Password</h2>
            <p class="mt-2 text-center text-sm text-gray-400">Secure your account with a strong new password.</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="bg-[#0A0A0A]/80 backdrop-blur-xl border border-gray-800 py-8 px-6 shadow-2xl shadow-black/50 rounded-3xl relative overflow-hidden">

                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/50 p-4 text-sm text-red-400">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route("password.update") }}" class="space-y-6 relative z-10" method="POST">
                    @csrf

                    <input name="token" type="hidden" value="{{ $token }}">

                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-300" for="email">Email address</label>
                        <div class="mt-2">
                            <input class="block w-full rounded-xl border-0 bg-[#111] px-4 py-3 text-gray-500 shadow-sm ring-1 ring-inset ring-gray-800 sm:text-sm cursor-not-allowed" id="email" name="email" readonly required type="email" value="{{ old("email", $email) }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-300" for="password">New Password</label>
                        <div class="mt-2">
                            <input class="block w-full rounded-xl border-0 bg-[#111] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 focus:ring-2 focus:ring-cyan-500 sm:text-sm" id="password" name="password" placeholder="••••••••••••" required type="password">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-300" for="password_confirmation">Confirm Password</label>
                        <div class="mt-2">
                            <input class="block w-full rounded-xl border-0 bg-[#111] px-4 py-3 text-white shadow-sm ring-1 ring-inset ring-gray-800 focus:ring-2 focus:ring-cyan-500 sm:text-sm" id="password_confirmation" name="password_confirmation" placeholder="••••••••••••" required type="password">
                        </div>
                    </div>

                    <div>
                        <button class="flex w-full justify-center rounded-xl bg-cyan-600 px-3 py-3.5 text-sm font-semibold leading-6 text-white shadow-lg shadow-cyan-500/20 hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600 transition-all duration-300 active:scale-[0.98]" type="submit">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
