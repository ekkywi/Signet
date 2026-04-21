<x-layouts.admin title="Signet | {{ $workspace->name }} Management">

    <div class="px-8 py-6 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <a class="p-2 bg-gray-800/50 hover:bg-gray-700 rounded-lg transition-colors text-white" href="{{ route("admin.workspaces.index") }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">{{ $workspace->name }}</h2>
                <p class="text-sm text-gray-500 mt-1 uppercase tracking-widest font-mono">ID: {{ $workspace->id }}</p>
            </div>
        </div>
        <div>
            @if ($workspace->status === "active")
                <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold px-3 py-1.5 rounded-full uppercase">Operational</span>
            @else
                <span class="bg-red-500/10 text-red-500 border border-red-500/20 text-xs font-bold px-3 py-1.5 rounded-full uppercase">Suspended</span>
            @endif
        </div>
    </div>

    <div class="p-8 max-w-6xl mx-auto space-y-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $apiLimit = $workspace->subscriptionPlan->monthly_api_limit;
                $apiPerc = ($workspace->api_usage_count / $apiLimit) * 100;
                $prodLimit = $workspace->subscriptionPlan->max_products;
                $prodPerc = ($productsCount / $prodLimit) * 100;
                $licLimit = $workspace->subscriptionPlan->max_licenses;
                $licPerc = ($licensesCount / $licLimit) * 100;
            @endphp

            <div class="bg-[#111] border border-gray-800 p-6 rounded-2xl">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm font-bold uppercase tracking-wider">API Requests</span>
                    <span class="text-xs font-mono {{ $apiPerc > 90 ? "text-red-500" : "text-emerald-400" }}">{{ number_format($apiPerc, 1) }}%</span>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ number_format($workspace->api_usage_count) }}</div>
                <div class="text-xs text-gray-500 mb-4">dari jatah {{ number_format($apiLimit) }} req/bulan</div>
                <div class="w-full bg-gray-900 rounded-full h-1.5 overflow-hidden">
                    <div class="h-full rounded-full {{ $apiPerc > 90 ? "bg-red-500" : "bg-blue-500" }}" style="width: {{ min($apiPerc, 100) }}%"></div>
                </div>
            </div>

            <div class="bg-[#111] border border-gray-800 p-6 rounded-2xl">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm font-bold uppercase tracking-wider">Registered Products</span>
                    <span class="text-xs font-mono text-emerald-400">{{ $productsCount }}/{{ $prodLimit }}</span>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ $productsCount }}</div>
                <div class="text-xs text-gray-500 mb-4 text-emerald-500/80">Kapasitas produk terdaftar</div>
                <div class="w-full bg-gray-900 rounded-full h-1.5 overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min($prodPerc, 100) }}%"></div>
                </div>
            </div>

            <div class="bg-[#111] border border-gray-800 p-6 rounded-2xl">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm font-bold uppercase tracking-wider">Generated Licenses</span>
                    <span class="text-xs font-mono text-emerald-400">{{ number_format($licensesCount) }}</span>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ number_format($licensesCount) }}</div>
                <div class="text-xs text-gray-500 mb-4">Maksimal {{ number_format($licLimit) }} lisensi</div>
                <div class="w-full bg-gray-900 rounded-full h-1.5 overflow-hidden">
                    <div class="h-full bg-blue-400 rounded-full" style="width: {{ min($licPerc, 100) }}%"></div>
                </div>
            </div>
        </div>

        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="px-6 py-4 border-b border-gray-800 bg-[#0a0a0a]">
                <h3 class="text-lg font-bold text-white font-sans">Subscription Management</h3>
                <p class="text-xs text-gray-500 mt-1">Mengubah paket akan secara otomatis memperbarui seluruh limit resource di atas.</p>
            </div>

            <form action="{{ route("admin.workspaces.change-plan", $workspace->id) }}" class="p-6" method="POST">
                @csrf
                @method("PATCH")

                <div class="max-w-xl">
                    <label class="block text-sm font-bold text-gray-400 mb-3">Pilih Paket Langganan</label>
                    <div class="flex items-center gap-4">
                        <select class="flex-1 bg-[#050505] border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" name="subscription_plan_id" required>
                            @foreach ($plans as $plan)
                                <option {{ $workspace->subscription_plan_id == $plan->id ? "selected" : "" }} value="{{ $plan->id }}">
                                    {{ $plan->name }} (API: {{ number_format($plan->monthly_api_limit) }} | Prod: {{ $plan->max_products }})
                                </option>
                            @endforeach
                        </select>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-8 py-3.5 rounded-xl transition-all shadow-[0_0_20px_rgba(37,99,235,0.2)]" type="submit">
                            Terapkan Paket
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="border border-red-900/50 rounded-2xl overflow-hidden bg-red-950/5 shadow-2xl">
            <div class="px-6 py-4 border-b border-red-900/30 bg-[#0a0a0a]">
                <h3 class="text-lg font-bold text-red-500">Security Access (Kill Switch)</h3>
                <p class="text-xs text-red-400/70 mt-1">Tindakan ini akan langsung menghentikan seluruh operasi kriptografi klien.</p>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-xl">
                        <h4 class="text-white font-bold">{{ $workspace->status === "active" ? "Bekukan Akses Workspace" : "Pulihkan Akses Workspace" }}</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $workspace->status === "active" ? "Membekukan workspace akan memblokir login user dan menolak semua request API Key yang terkait." : "Memulihkan akses akan mengaktifkan kembali seluruh fungsi dashboard dan API klien." }}
                        </p>
                    </div>

                    <form action="{{ route("admin.workspaces.toggle-status", $workspace->id) }}" class="w-full md:w-80" method="POST">
                        @csrf
                        @if ($workspace->status === "active")
                            <input class="w-full bg-[#111] border border-red-900/30 rounded-lg px-4 py-2 text-sm text-white mb-3 outline-none focus:border-red-500" name="suspension_reason" placeholder="Alasan pembekuan..." required type="text">
                            <button class="w-full bg-red-600/10 border border-red-600 text-red-500 hover:bg-red-600 hover:text-white text-sm font-bold py-3 rounded-xl transition-all" type="submit">
                                AKTIFKAN KILL SWITCH
                            </button>
                        @else
                            <div class="mb-3 p-3 rounded-lg bg-red-900/20 border border-red-900/40 text-xs text-red-400">
                                <span class="font-bold block mb-1">Alasan Terakhir:</span>
                                "{{ $workspace->suspension_reason }}"
                            </div>
                            <button class="w-full bg-emerald-600/10 border border-emerald-600 text-emerald-500 hover:bg-emerald-600 hover:text-white text-sm font-bold py-3 rounded-xl transition-all" type="submit">
                                PULIHKAN AKSES SEKARANG
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layouts.admin>
