<!DOCTYPE html>
<html class="h-full bg-[#030303]" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Signet | Verify Your Email</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
</head>

<body class="h-full flex items-center justify-center text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300 relative" style="font-family: 'Poppins', sans-serif;">

    <div class="fixed inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,#151515_1px,transparent_1px),linear-gradient(to_bottom,#151515_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-teal-600/10 blur-[100px] rounded-full pointer-events-none -z-10"></div>

    <div class="w-full max-w-md px-6 lg:px-8 py-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm flex flex-col items-center text-center">
            <div class="w-16 h-16 border border-gray-700 bg-[#111] rounded-2xl flex items-center justify-center shadow-lg shadow-teal-500/20 mb-6">
                <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold leading-9 tracking-tight text-white mb-2">Check your inbox</h2>
            <p class="text-sm text-gray-400 mb-8">
                We've sent a verification link to your email address. Please click the link to initialize your Signet Account.
            </p>
        </div>

        <div class="bg-[#0A0A0A]/80 backdrop-blur-xl border border-gray-800 py-8 px-6 shadow-2xl shadow-black/50 rounded-3xl text-center">

            @if (session("status") == "verification-link-sent")
                <div class="mb-6 rounded-xl bg-teal-500/10 border border-teal-500/50 p-4 text-sm font-medium text-teal-400">
                    A new verification link has been sent to your email!
                </div>
            @endif

            <form action="{{ route("verification.send") }}" method="POST">
                @csrf
                <button class="w-full flex justify-center rounded-xl bg-[#111] border border-gray-700 px-3 py-3.5 text-sm font-semibold leading-6 text-white hover:bg-gray-800 transition-all duration-300" type="submit">
                    Resend Verification Email
                </button>
            </form>

            <form action="/logout" class="mt-4" method="POST">
                @csrf
                <button class="text-sm font-medium text-gray-500 hover:text-white transition-colors" type="submit">
                    Log out and try another account
                </button>
            </form>
        </div>
    </div>
</body>

</html>
