<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Documentation | Signet by Trezanix</title>

    @vite(["resources/css/app.css", "resources/js/app.js"])

    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
</head>

<body class="bg-[#030303] text-gray-200 antialiased selection:bg-teal-500/20 selection:text-teal-300" style="font-family: 'Poppins', sans-serif;">

    <div class="fixed inset-0 -z-10 h-full w-full bg-[#030303] bg-[linear-gradient(to_right,#151515_1px,transparent_1px),linear-gradient(to_bottom,#151515_1px,transparent_1px)] bg-[size:4rem_4rem]">
        <div class="absolute top-0 right-0 w-[500px] h-[300px] bg-teal-600/10 blur-[120px] rounded-full pointer-events-none -z-10"></div>
    </div>

    <nav class="fixed w-full z-50 border-b border-gray-800/50 bg-[#030303]/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a class="flex items-center gap-3 group" href="/">
                    <div class="w-8 h-8 border border-gray-700 bg-[#111] rounded-lg flex items-center justify-center shadow-lg group-hover:border-teal-500/50 transition-colors duration-300 relative overflow-hidden">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-teal-400 transition-colors duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-sm text-gray-400 group-hover:text-white transition-colors duration-300">Back to Home</span>
                </a>

                <div class="flex items-center space-x-4">
                    <a class="text-sm font-semibold text-white bg-[#111] hover:bg-gray-800 border border-gray-800 px-5 py-2 rounded-full transition-all duration-300 shadow-lg" href="/login">
                        Sign in to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <header class="pt-36 pb-12 sm:pt-48 sm:pb-16 lg:pt-52 border-b border-gray-800/80 bg-[#050505]/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-500/20 text-xs font-mono text-teal-400 mb-6">Documentation Overview</div>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight mb-4">How Signet Works.</h1>
            <p class="max-w-2xl text-lg text-gray-400 leading-relaxed">
                Understand the architecture, security models, and implementation strategies of the Signet Licensing Platform before you start integrating it into your code.
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row gap-16">

            <div class="w-full md:w-64 flex-shrink-0 relative">

                <div class="sticky top-36">
                    <h4 class="text-xs font-bold text-gray-300 uppercase tracking-widest mb-4">Contents</h4>
                    <ul class="space-y-3 border-l border-gray-800 pl-4" id="toc-menu">
                        <li>
                            <a class="toc-link block text-sm font-medium transition-all duration-300 -ml-[17px] pl-4 border-l-2 text-teal-400 border-teal-500" href="#introduction">Introduction</a>
                        </li>
                        <li>
                            <a class="toc-link block text-sm font-medium transition-all duration-300 -ml-[17px] pl-4 border-l-2 text-gray-500 border-transparent hover:text-gray-300" href="#hsm-security">Micro HSM Security</a>
                        </li>
                        <li>
                            <a class="toc-link block text-sm font-medium transition-all duration-300 -ml-[17px] pl-4 border-l-2 text-gray-500 border-transparent hover:text-gray-300" href="#license-types">License Types</a>
                        </li>
                        <li>
                            <a class="toc-link block text-sm font-medium transition-all duration-300 -ml-[17px] pl-4 border-l-2 text-gray-500 border-transparent hover:text-gray-300" href="#integration">Integration Flow</a>
                        </li>
                    </ul>

                    <div class="mt-8 p-5 rounded-2xl bg-gradient-to-b from-[#111] to-[#0A0A0A] border border-gray-800">
                        <h5 class="text-sm font-bold text-white mb-2">Ready to code?</h5>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Log in to your workspace to access the technical API endpoints, JSON structures, and your API Keys.</p>
                        <a class="text-xs font-bold text-teal-400 hover:text-teal-300 flex items-center gap-1" href="/login">
                            Go to Developer API
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="flex-1 space-y-20 pb-20 max-w-3xl">

                <section class="scroll-mt-32" id="introduction">
                    <h2 class="text-3xl font-bold text-white mb-6">The New Standard in Software Licensing</h2>
                    <p class="text-gray-400 leading-relaxed mb-6 text-lg">
                        Signet isn't just another license manager; it's a cryptographic fortress for your digital assets. Built from the ground up by Trezanix, Signet delivers API-first, military-grade licensing—empowering developers to generate serials, enforce strict hardware binding, and manage subscriptions without the exorbitant enterprise price tag.
                    </p>
                    <p class="text-gray-400 leading-relaxed">
                        Whether you're shipping a high-performance C++ desktop engine, a cross-platform Rust/Tauri app, or a sleek Node.js backend, Signet's universal REST API integrates into your deployment pipeline in minutes, not days.
                    </p>
                </section>

                <section class="scroll-mt-32" id="hsm-security">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center border border-orange-500/20 shadow-lg shadow-orange-500/10">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-white tracking-tight">Hardware-Backed Cryptography</h2>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Most licensing servers store your cryptographic private keys in vulnerable SQL databases or basic environment files. If their server is compromised, your keys are stolen, and pirates can mint fake licenses indefinitely. <strong>Signet rewrites the rules.</strong>
                    </p>
                    <p class="text-gray-400 leading-relaxed mb-8">
                        We utilize proprietary <strong>Micro Hardware Security Modules (HSMs)</strong> custom-engineered by Trezanix. Your cryptographic signatures are calculated directly inside physically isolated silicon chips, rendering database leaks irrelevant.
                    </p>
                    <div class="bg-gradient-to-br from-[#111] to-[#0A0A0A] border border-gray-800 p-7 rounded-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-teal-900/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <h4 class="text-base font-bold text-gray-200 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            The Zero-Knowledge Guarantee
                        </h4>
                        <p class="text-sm text-gray-400 leading-relaxed relative z-10">
                            When your client validates a key, our API simply acts as a secure courier. The payload is forwarded to the HSM cluster, signed via ECDSA, and returned. <strong>The private key never touches the internet, memory, or storage.</strong> Even our own system administrators cannot extract it.
                        </p>
                    </div>
                </section>

                <section class="scroll-mt-32" id="license-types">
                    <h2 class="text-3xl font-bold text-white mb-6">Architected for Every Business Model</h2>
                    <p class="text-gray-400 leading-relaxed mb-8">
                        Signet natively supports two formidable licensing paradigms, allowing you to adapt to any market demand—from indie utilities to high-ticket enterprise software.
                    </p>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div class="bg-[#111] border border-gray-800 p-7 rounded-2xl hover:border-purple-500/40 hover:bg-[#151515] transition-all duration-300 shadow-xl shadow-black/50 group">
                            <h3 class="text-lg font-bold text-purple-400 mb-3 flex items-center gap-2.5">
                                <span class="p-1.5 rounded-lg bg-purple-500/10 group-hover:bg-purple-500/20 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                </span>
                                Node-Locked
                            </h3>
                            <p class="text-sm text-gray-400 leading-relaxed">
                                The ultimate anti-piracy measure. The license is cryptographically fused to a user's specific Machine ID (MAC Address, CPU Serial, or UUID). If a user attempts to clone the VM or copy the software to an unauthorized device, validation fails instantly.
                            </p>
                        </div>
                        <div class="bg-[#111] border border-gray-800 p-7 rounded-2xl hover:border-teal-500/40 hover:bg-[#151515] transition-all duration-300 shadow-xl shadow-black/50 group">
                            <h3 class="text-lg font-bold text-teal-400 mb-3 flex items-center gap-2.5">
                                <span class="p-1.5 rounded-lg bg-teal-500/10 group-hover:bg-teal-500/20 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                </span>
                                Floating (Seat-Based)
                            </h3>
                            <p class="text-sm text-gray-400 leading-relaxed">
                                Seamless scalability for modern teams. The license tracks active concurrent sessions. Users can install the software on any machine, but usage is strictly capped to their purchased "Activation Slots". Ideal for SaaS and B2B deployments.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="scroll-mt-32" id="integration">
                    <h2 class="text-3xl font-bold text-white mb-6">Frictionless Developer Experience</h2>

                    <p class="text-gray-400 leading-relaxed mb-10">
                        We despise complex integration processes. Signet operates via pure HTTP REST APIs, and we provide <strong>Official Drop-in SDKs</strong> (Python, C++, C#, etc.) to handle the heavy cryptographic lifting for you. Here is your path to total security:
                    </p>

                    <div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-800 before:to-transparent">

                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-[#050505] bg-teal-500/20 text-teal-400 font-bold shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">1</div>
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl bg-[#0A0A0A] border border-gray-800 hover:border-gray-700 transition-colors shadow-lg">
                                <h4 class="text-white font-bold mb-1">Register Your App</h4>
                                <p class="text-sm text-gray-500 leading-relaxed">Log into the Signet Console and define your product ecosystem. Set your default security policies in seconds.</p>
                            </div>
                        </div>

                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-[#050505] bg-teal-500/20 text-teal-400 font-bold shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">2</div>
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl bg-[#0A0A0A] border border-gray-800 hover:border-gray-700 transition-colors shadow-lg">
                                <h4 class="text-white font-bold mb-1">Acquire API Credentials</h4>
                                <p class="text-sm text-gray-500 leading-relaxed">Generate a secure <code class="text-xs text-teal-400 bg-teal-500/10 px-1 rounded">x-api-key</code>. This token will authenticate your client application's requests to our infrastructure.</p>
                            </div>
                        </div>

                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-[#050505] bg-teal-500/20 text-teal-400 font-bold shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">3</div>
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl bg-[#0A0A0A] border border-gray-800 hover:border-gray-700 transition-colors shadow-lg">
                                <h4 class="text-white font-bold mb-1">Mint Licenses</h4>
                                <p class="text-sm text-gray-500 leading-relaxed">Issue cryptographically secure serial keys (e.g., <code class="text-xs text-gray-400 bg-gray-800 px-1 rounded font-mono">XXXX-XXXX-XXXX</code>) to your paying customers via the dashboard.</p>
                            </div>
                        </div>

                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-[#050505] bg-teal-500/20 text-teal-400 font-bold shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">4</div>
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl bg-[#0A0A0A] border border-gray-800 hover:border-teal-900/50 hover:bg-[#111] transition-colors shadow-lg shadow-teal-900/10">
                                <h4 class="text-white font-bold mb-1">Verify and Unlock</h4>
                                <p class="text-sm text-gray-500 leading-relaxed">Send a <code class="text-xs text-teal-400 bg-teal-500/10 px-1 rounded">POST /validate</code> request. Signet returns a Base64 signature. Use our <strong>Client SDK</strong> to mathematically verify the payload locally against your Public Key. If valid, unlock the software!</p>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </div>

    <footer class="py-12 border-t border-gray-800/80 bg-[#030303]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-600">
                Signet is an advanced software licensing product engineered by <a class="text-teal-600 hover:text-teal-500 font-medium" href="https://trezanix.com">Trezanix</a>.<br>
                &copy; {{ date("Y") }} All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section[id]');
            const tocLinks = document.querySelectorAll('.toc-link');

            const observerOptions = {
                root: null,
                rootMargin: '-150px 0px -60% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const activeId = entry.target.getAttribute('id');

                        tocLinks.forEach(link => {
                            link.classList.remove('text-teal-400', 'border-teal-500');
                            link.classList.add('text-gray-500', 'border-transparent');

                            if (link.getAttribute('href') === `#${activeId}`) {
                                link.classList.remove('text-gray-500', 'border-transparent');
                                link.classList.add('text-teal-400', 'border-teal-500');
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>

</html>
