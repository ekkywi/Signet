<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Signet | Free & Bulletproof Software Licensing for Developers</title>

    @vite(["resources/css/app.css", "resources/js/app.js"])

    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
</head>

<body class="bg-[#030303] text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300" style="font-family: 'Poppins', sans-serif;">

    <div class="fixed inset-0 -z-10 h-full w-full bg-[#030303] bg-[linear-gradient(to_right,#151515_1px,transparent_1px),linear-gradient(to_bottom,#151515_1px,transparent_1px)] bg-[size:4rem_4rem]">
        <div class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_500px_at_50%_200px,#1a1a1a,transparent)]"></div>
    </div>

    <nav class="fixed w-full z-50 border-b border-gray-800/50 bg-[#030303]/60 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a class="flex items-center gap-3 group" href="/">
                    <div class="w-9 h-9 border border-gray-700 bg-[#111] rounded-xl flex items-center justify-center shadow-lg group-hover:border-teal-500/50 transition-colors duration-300 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-600/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-teal-400 transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-white group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-white group-hover:to-gray-400 transition-all duration-300">Signet</span>
                </a>

                <div class="hidden md:flex items-center space-x-10">
                    <a class="text-sm font-medium text-gray-400 hover:text-white transition-colors" href="#features">Platform</a>
                    <a class="text-sm font-medium text-gray-400 hover:text-white transition-colors" href="#hsm">API Flow</a>
                    <a class="text-sm font-medium text-gray-400 hover:text-white transition-colors" href="#faq">FAQ</a>
                </div>

                <div class="hidden md:flex items-center space-x-4 border-l border-gray-800/80 pl-8">
                    <a class="text-sm font-medium text-gray-400 hover:text-white transition-colors" href="/login">Sign in</a>
                    <a class="text-sm font-semibold text-white bg-teal-600 hover:bg-teal-500 px-5 py-2.5 rounded-full transition-all duration-300 shadow-lg shadow-teal-500/20 active:scale-95" href="/register">
                        Start for Free
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative pt-36 pb-20 sm:pt-48 sm:pb-28 lg:pb-36 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-teal-600/20 blur-[130px] rounded-full pointer-events-none -z-10"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-center text-center">

            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-[#111] border border-gray-800/80 text-sm text-gray-400 mb-10 shadow-lg shadow-black/30">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-500"></span>
                </span>
                100% Free. Built by developers, for developers.
            </div>

            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-extrabold tracking-tighter mb-6 leading-[0.95] text-white">
                Bulletproof<br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 via-white to-purple-400">
                    Software Licensing.
                </span>
            </h1>

            <p class="max-w-3xl text-xl sm:text-2xl text-gray-400 mb-12 font-medium leading-relaxed">
                Protect your digital assets from piracy without breaking the bank. Generate secure serial keys, enforce node-locked hardware binding, and validate licenses—completely free for the community.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 w-full sm:w-auto z-10">
                <a class="w-full sm:w-auto flex items-center justify-center px-10 py-4 text-lg font-semibold rounded-full text-white bg-teal-600 hover:bg-teal-500 transition-all duration-300 shadow-xl shadow-teal-500/20 active:scale-95" href="/register">
                    Create Free Workspace
                    <svg class="w-5 h-5 ml-2.5 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                    </svg>
                </a>
                <a class="w-full sm:w-auto flex items-center justify-center px-10 py-4 text-lg font-semibold rounded-full text-gray-300 bg-[#0A0A0A] hover:bg-[#111] border border-gray-700/80 hover:border-gray-600 transition-all duration-300 active:scale-95" href="{{ route("help.index") }}">
                    Explore API Docs
                </a>
            </div>

            <div class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-7xl relative z-10 text-left" id="features">
                <div class="group bg-[#0A0A0A]/70 backdrop-blur-sm border border-gray-800 p-9 rounded-3xl hover:border-teal-500/50 hover:bg-[#111] transition-all duration-500 shadow-2xl shadow-black/40 flex flex-col relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="w-16 h-16 bg-teal-500/10 rounded-2xl flex items-center justify-center mb-8 border border-teal-500/20 group-hover:scale-110 group-hover:border-teal-500/40 transition-all duration-500 relative z-10">
                        <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 tracking-tight relative z-10">Dynamic API Licenses</h3>
                    <p class="text-gray-400 leading-relaxed text-base mb-6 flex-grow relative z-10">
                        Generate robust serial numbers (e.g., XXXX-XXXX-XXXX) instantly. Validate user subscriptions and access limits in real-time without worrying about expensive API costs.
                    </p>
                </div>

                <div class="group bg-[#0A0A0A]/70 backdrop-blur-sm border border-gray-800 p-9 rounded-3xl hover:border-purple-500/50 hover:bg-[#111] transition-all duration-500 shadow-2xl shadow-black/40 flex flex-col relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="w-16 h-16 bg-purple-500/10 rounded-2xl flex items-center justify-center mb-8 border border-purple-500/20 group-hover:scale-110 group-hover:border-purple-500/40 transition-all duration-500 relative z-10">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 tracking-tight relative z-10">Node-Locked Binding</h3>
                    <p class="text-gray-400 leading-relaxed text-base mb-6 flex-grow relative z-10">
                        Stop unauthorized distribution permanently. Tie licenses directly to the end-user's Machine ID (MAC Address or CPU ID). If the software is copied to another device, it locks down instantly.
                    </p>
                </div>

                <div class="group bg-[#0A0A0A]/70 backdrop-blur-sm border border-gray-800 p-9 rounded-3xl hover:border-orange-500/50 hover:bg-[#111] transition-all duration-500 shadow-2xl shadow-black/40 flex flex-col relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="w-16 h-16 bg-orange-500/10 rounded-2xl flex items-center justify-center mb-8 border border-orange-500/20 group-hover:scale-110 group-hover:border-orange-500/40 transition-all duration-500 relative z-10">
                        <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 tracking-tight relative z-10">Hardware-Backed Security</h3>
                    <p class="text-gray-400 leading-relaxed text-base mb-6 flex-grow relative z-10">
                        Enterprise security, democratized. Signet generates and signs your licenses using our custom-made Hardware Security Modules. Cryptographic keys remain physically isolated and tamper-proof.
                    </p>
                </div>
            </div>
        </div>
    </header>

    <section class="relative py-24 sm:py-32 overflow-hidden border-t border-gray-800/80 bg-[#050505]" id="crypto">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative flex justify-center">
                    <div class="absolute inset-0 bg-gradient-to-tr from-teal-500/10 via-transparent to-purple-500/10 blur-3xl rounded-full"></div>
                    <div class="relative w-72 h-72 sm:w-80 sm:h-80 bg-[#0A0A0A] border-2 border-gray-800 rounded-3xl shadow-2xl shadow-teal-900/20 flex items-center justify-center group overflow-hidden">
                        <div class="absolute inset-0 opacity-20 group-hover:opacity-40 transition-opacity duration-700 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-teal-400 via-transparent to-transparent"></div>
                        <div class="w-32 h-32 bg-[#111] border border-gray-700 rounded-xl shadow-inner flex flex-col items-center justify-center relative z-10">
                            <div class="w-16 h-16 border border-gray-600 rounded mb-2 flex items-center justify-center bg-black/50">
                                <svg class="w-8 h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-mono text-gray-500 tracking-widest uppercase">Trezanix Micro HSM</span>
                        </div>
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1 h-8 bg-gray-800"></div>
                        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-8 bg-gray-800"></div>
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-8 h-1 bg-gray-800"></div>
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-8 h-1 bg-gray-800"></div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-500/20 text-xs font-mono text-teal-400 mb-6">Custom Silicon Architecture</div>
                    <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight mb-6">Engineered from the<br>Silicon Up.</h2>
                    <p class="text-lg text-gray-400 leading-relaxed mb-8">
                        True security requires physical isolation. We didn't just write software; we custom-engineered our own <strong class="text-gray-200">Proprietary Micro HSMs</strong> to act as the cryptographic heart of the Signet platform.
                    </p>
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-white font-semibold flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                Zero-Trust Verification
                            </h4>
                            <p class="text-sm text-gray-400 pl-7">We utilize high-speed <strong class="text-gray-300">ECDSA (secp256r1)</strong> for digital signatures. Your client app verifies the payload locally using an embedded Public Key, rendering server-spoofing attacks mathematically impossible.</p>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                Zero-Knowledge Boundary
                            </h4>
                            <p class="text-sm text-gray-400 pl-7">Private keys are flashed directly into the physical silicon of our custom HSM cluster. They never leave the hardware, meaning even our own server administrators cannot extract them.</p>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                Why is it Free?
                            </h4>
                            <p class="text-sm text-gray-400 pl-7">Enterprise HSM solutions cost thousands of dollars per month. By researching, designing, and hosting our own hardware infrastructure in-house, we slashed overhead costs by 99%—allowing us to give it back to the developer community for free.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-24 sm:py-32 overflow-hidden border-t border-gray-800/80 bg-[#060606]" id="hsm">
        <div class="absolute bottom-0 right-0 w-[500px] h-[300px] bg-purple-600/10 blur-[120px] rounded-full pointer-events-none -z-10"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight mb-8">The Anatomy of<br>Unbreakable Trust.</h2>
                    <p class="text-lg text-gray-400 leading-relaxed mb-10 max-w-lg">
                        We believe enterprise-grade protection shouldn't cost a fortune. Whether you need standard subscription keys for indie SaaS products, or strict Node-Locked cryptography for premium desktop apps—Signet handles it all.
                    </p>
                    <div class="space-y-4 font-mono text-sm text-gray-400">
                        <div class="flex items-center gap-4 bg-[#0A0A0A] border border-gray-800 rounded-xl p-4">
                            <svg class="w-6 h-6 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <span>Client requests validation via Signet REST API.</span>
                        </div>
                        <div class="flex items-center gap-4 bg-[#0A0A0A] border border-gray-800 rounded-xl p-4">
                            <svg class="w-6 h-6 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <span>Payload matches Machine ID (MAC/CPU footprint).</span>
                        </div>
                        <div class="flex items-center gap-4 bg-[#0A0A0A] border border-gray-800 rounded-xl p-4">
                            <svg class="w-6 h-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <span>Signet HSM returns a Base64 Signature. Your Client SDK verifies it locally. Access Granted.</span>
                        </div>
                    </div>
                </div>
                <div class="relative bg-[#0A0A0A] border border-gray-800 p-8 rounded-3xl shadow-3xl shadow-black/50 overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-700/5 to-black/20 group-hover:from-teal-900/10 group-hover:to-purple-900/10 transition-colors duration-700"></div>
                    <div class="w-full bg-[#111] border border-gray-700 rounded-xl p-6 relative z-10 shadow-2xl">
                        <div class="flex justify-between items-center border-b border-gray-800 pb-4 mb-4">
                            <span class="text-gray-300 font-semibold">License Configuration</span>
                            <span class="px-3 py-1 bg-teal-500/20 text-teal-400 text-xs rounded-full border border-teal-500/30">Active</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-xs text-gray-500 block mb-1 uppercase tracking-wider">Serial Key</span>
                            <div class="font-mono text-white bg-black border border-gray-800 rounded px-4 py-2 tracking-widest text-sm">SGNT-A8X9-B4L2-99PZ</div>
                        </div>
                        <div class="flex items-center justify-between bg-gray-900/50 p-3 rounded border border-gray-800">
                            <div>
                                <span class="text-xs text-gray-500 block uppercase tracking-wider">Node-Lock Status</span>
                                <span class="text-sm text-gray-300 font-mono mt-1 block">Bound to: 00:1A:2B:3C:4D:5E</span>
                            </div>
                            <div class="w-10 h-5 bg-teal-500 rounded-full relative shadow-lg shadow-teal-500/20">
                                <div class="w-4 h-4 bg-white rounded-full absolute right-0.5 top-0.5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-teal-600/10 blur-[60px] rounded-full pointer-events-none -z-10 group-hover:bg-teal-600/20 transition-colors"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 border-t border-gray-800/80 bg-[#040404] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center mb-6">
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Platform Agnostic. Integrates via pure HTTP REST API or our Official Drop-in SDKs.</p>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 max-w-4xl mx-auto px-6 opacity-80">
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-teal-400 hover:border-teal-900 transition-colors">C++ / Qt</span>
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-purple-400 hover:border-purple-900 transition-colors">Rust / Tauri</span>
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-orange-400 hover:border-orange-900 transition-colors">C# / .NET</span>
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-blue-400 hover:border-blue-900 transition-colors">Electron / Node.js</span>
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-yellow-400 hover:border-yellow-900 transition-colors">Python</span>
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-cyan-400 hover:border-cyan-900 transition-colors">Go</span>
            <span class="px-4 py-2 bg-[#111] border border-gray-800 rounded-lg text-sm text-gray-400 font-mono hover:text-red-400 hover:border-red-900 transition-colors">Java</span>
        </div>
    </section>

    <section class="py-24 sm:py-32 border-t border-gray-800/80 bg-[#060606]" id="faq">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-400">Everything you need to know about Signet and our free community tier.</p>
            </div>

            <div class="space-y-6">
                <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl p-6 sm:p-8 hover:border-gray-700 transition-colors">
                    <h3 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        Is it genuinely 100% free? What's the catch?
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        There is no catch. By designing and building our Micro HSM infrastructure in-house, our operational costs are exceptionally low compared to standard enterprise security providers. We built this tool for our own products, and we've opened it up to the community for free.
                    </p>
                </div>

                <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl p-6 sm:p-8 hover:border-gray-700 transition-colors">
                    <h3 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        What happens if the Signet API goes offline?
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Your app won't break. Signet utilizes asymmetric cryptography (ECDSA). Once a license payload is validated and cached locally on your client's machine, your application can cryptographically verify the signature offline without ever needing to contact our servers again (until the license expires).
                    </p>
                </div>

                <div class="bg-[#0A0A0A] border border-gray-800 rounded-2xl p-6 sm:p-8 hover:border-gray-700 transition-colors">
                    <h3 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        How does Node-Locking prevent VM cloning?
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        When creating a license, you can enforce hardware binding. Your client app extracts specific hardware footprints (such as MAC addresses, CPU IDs, or Motherboard serials) and sends them during validation. If a user copies the app/VM to a new physical host, the footprint changes, and the license instantly invalidates itself.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 sm:py-32 relative overflow-hidden border-t border-gray-800/80 bg-[#030303]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10 flex flex-col items-center">
            <h2 class="text-5xl sm:text-6xl font-extrabold tracking-tighter text-white mb-8 leading-tight">Stop Piracy Before It Starts.</h2>
            <p class="max-w-2xl text-xl text-gray-400 leading-relaxed mb-12 font-medium">
                Take full control of your software distribution without paying enterprise fees. Empower your applications with Signet's custom hardware architecture and flexible Node-Locked licensing today.
            </p>
            <div class="flex gap-4">
                <a class="flex items-center px-10 py-4 text-lg font-semibold rounded-full text-white bg-teal-600 hover:bg-teal-500 transition-all duration-300 shadow-xl shadow-teal-500/20 active:scale-95" href="/register">
                    Start Securing Your App (Free)
                    <svg class="w-5 h-5 ml-2.5 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="absolute top-0 right-1/4 w-[600px] h-[400px] bg-purple-600/15 blur-[120px] rounded-full pointer-events-none -z-10"></div>
    </section>

    <footer class="py-16 border-t border-gray-800/80 bg-[#060606]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-3 mb-8">
                <div class="w-7 h-7 bg-[#111] rounded-lg flex items-center justify-center border border-gray-800">
                    <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <span class="text-gray-200 font-bold">&copy; {{ date("Y") }} Signet Console.</span>
            </div>
            <p class="text-sm text-gray-600">
                Signet is an advanced software licensing product engineered by <a class="text-teal-600 hover:text-teal-500 font-medium" href="https://trezanix.com">Trezanix</a>.<br>
                From developers, to developers. Completely free to use.
            </p>
        </div>
    </footer>

</body>

</html>
