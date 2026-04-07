<x-layouts.app title="Signet | Audit Logs">
    <div class="px-8 py-8 border-b border-gray-800/50 bg-[#0a0a0a]/50 sticky top-0 backdrop-blur-xl z-10">
        <div class="max-w-7xl mx-auto w-full">
            <h2 class="text-2xl font-bold text-white tracking-tight">Audit Trail</h2>
            <p class="text-sm text-gray-500 mt-1">Monitor all administrative actions and data changes within your workspace.</p>
        </div>

    </div>

    <div class="p-8 max-w-7xl mx-auto w-full pb-20">
        <div class="bg-[#111] border border-gray-800 rounded-2xl p-4 mb-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">

            <form action="{{ route("logs.index") }}" class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto" id="filter-form" method="GET">

                <div class="flex items-center gap-2 bg-[#0a0a0a] border border-gray-800 rounded-xl px-3 py-1.5 w-full sm:w-auto">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <input class="bg-transparent border-0 text-sm text-gray-300 focus:ring-0 w-56 placeholder-gray-600" id="date_range" placeholder="Select Date Range" type="text">
                </div>

                <input id="start_date" name="start_date" type="hidden" value="{{ $startDate }}">
                <input id="end_date" name="end_date" type="hidden" value="{{ $endDate }}">

                <button class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors border border-gray-700" type="submit">
                    Apply Filter
                </button>
            </form>

            <button class="w-full sm:w-auto flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-500 text-white px-4 py-2 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-teal-500/10" onclick="exportToCsv()" type="button">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                Export CSV
            </button>

        </div>
        <div class="bg-[#111] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-[#0a0a0a] border-b border-gray-800 text-xs uppercase font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Timestamp</th>
                            <th class="px-6 py-4">Actor</th>
                            <th class="px-6 py-4">Action</th>
                            <th class="px-6 py-4">Target Resource</th>
                            <th class="px-6 py-4">Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-white/[0.01] transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                    {{ $log->created_at->format("M d, Y • H:i:s") }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-300">
                                        {{ $log->user ? $log->user->name : "System" }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $color = match ($log->action) {
                                            "created" => "text-green-400 bg-green-400/10 border-green-400/20",
                                            "updated" => "text-blue-400 bg-blue-400/10 border-blue-400/20",
                                            "deleted" => "text-red-400 bg-red-400/10 border-red-400/20",
                                            "login" => "text-teal-400 bg-teal-400/10 border-teal-400/20",
                                            "logout" => "text-amber-400 bg-amber-400/10 border-amber-400/20",
                                            default => "text-gray-400 bg-gray-400/10 border-gray-400/20",
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase border {{ $color }}">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-white font-medium">
                                            {{ class_basename($log->auditable_type) }}
                                            <span class="text-gray-400 font-normal ml-1">
                                                ({{ $log->target_name }})
                                            </span>
                                        </span>
                                        <span class="text-[10px] text-gray-600 font-mono mt-0.5" title="{{ $log->auditable_id }}">
                                            {{ Str::limit($log->auditable_id, 13) }}...
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-teal-400 hover:text-teal-300 text-xs font-semibold flex items-center gap-1 transition-colors" onclick='showLogDetail(@json($log))'>
                                        View Changes
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-20 text-center text-gray-500 italic" colspan="4">No activity logs recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($logs->hasPages())
                <div class="px-6 py-4 border-t border-gray-800 bg-[#0a0a0a]/50">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    <div class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4" id="log-modal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeLogModal()"></div>
        <div class="relative bg-[#111] border border-gray-800 rounded-2xl w-full max-w-4xl max-h-[80vh] overflow-hidden flex flex-col shadow-2xl">
            <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center bg-[#0a0a0a]">
                <h3 class="text-white font-bold">Data Changes Preview</h3>
                <button class="text-gray-500 hover:text-white" onclick="closeLogModal()">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Original Data (Old)</p>
                        <pre class="bg-black/50 p-4 rounded-xl border border-gray-800 text-[11px] text-red-400/80 font-mono overflow-x-auto min-h-[100px]" id="old-data-box"></pre>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">New Data (Current)</p>
                        <pre class="bg-black/50 p-4 rounded-xl border border-gray-800 text-[11px] text-green-400/80 font-mono overflow-x-auto min-h-[100px]" id="new-data-box"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://npmcdn.com/flatpickr/dist/themes/dark.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function showLogDetail(log) {
            const oldDataBox = document.getElementById('old-data-box');
            const newDataBox = document.getElementById('new-data-box');

            if (!log.old_data || Object.keys(log.old_data).length === 0) {
                oldDataBox.textContent = "NULL\n(This is a newly created resource)";
                oldDataBox.classList.replace('text-red-400/80', 'text-gray-500');
            } else {
                oldDataBox.textContent = JSON.stringify(log.old_data, null, 2);
                oldDataBox.classList.replace('text-gray-500', 'text-red-400/80');
            }

            if (!log.new_data || Object.keys(log.new_data).length === 0) {
                newDataBox.textContent = "NULL\n(This resource was deleted)";
                newDataBox.classList.replace('text-green-400/80', 'text-gray-500');
            } else {
                newDataBox.textContent = JSON.stringify(log.new_data, null, 2);
                newDataBox.classList.replace('text-gray-500', 'text-green-400/80');
            }

            document.getElementById('log-modal').classList.remove('hidden');
        }

        function closeLogModal() {
            document.getElementById('log-modal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                defaultDate: ["{{ $startDate }}", "{{ $endDate }}"],
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const start = selectedDates[0];
                        const end = selectedDates[1];

                        document.getElementById('start_date').value = start.getFullYear() + "-" + String(start.getMonth() + 1).padStart(2, '0') + "-" + String(start.getDate()).padStart(2, '0');
                        document.getElementById('end_date').value = end.getFullYear() + "-" + String(end.getMonth() + 1).padStart(2, '0') + "-" + String(end.getDate()).padStart(2, '0');
                    }
                }
            });
        });

        function exportToCsv() {
            const form = document.getElementById('filter-form');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'export';
            input.value = 'csv';
            form.appendChild(input);

            form.submit();

            setTimeout(() => {
                input.remove();
            }, 1000);
        }
    </script>
</x-layouts.app>
