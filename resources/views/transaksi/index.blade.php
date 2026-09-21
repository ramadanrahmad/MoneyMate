<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-100 tracking-tight">
                {{ __('Dashboard Keuangan') }}
            </h2>
            
            <div class="flex items-center space-x-4 w-full md:w-auto">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-2 bg-white dark:bg-gray-800 p-1 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 w-full md:w-auto">
                    <select name="month" class="border-transparent dark:bg-gray-800 dark:text-gray-200 focus:border-transparent focus:ring-0 text-sm py-1.5 pl-3 pr-8 rounded-lg cursor-pointer font-medium" onchange="this.form.submit()">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $month == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                            </option>
                        @endfor
                    </select>
                    <div class="h-5 w-px bg-gray-200 dark:bg-gray-700"></div>
                    <select name="year" class="border-transparent dark:bg-gray-800 dark:text-gray-200 focus:border-transparent focus:ring-0 text-sm py-1.5 pl-3 pr-8 rounded-lg cursor-pointer font-medium" onchange="this.form.submit()">
                        @for($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </form>

                <a href="{{ route('transaksi.create') }}" class="shrink-0 inline-flex items-center px-4 py-2.5 bg-[#F4A261] rounded-xl font-bold text-sm text-white hover:bg-[#e09355] focus:outline-none focus:ring-2 focus:ring-[#F4A261] focus:ring-offset-2 transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i> Tambah
                </a>
            </div>
        </div>
    </x-slot>

    <div>
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Saldo Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex flex-col items-center justify-center relative overflow-hidden group hover:shadow-md transition-shadow">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 dark:bg-blue-900/20 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center mb-4 z-10">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium z-10">Sisa Saldo</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 z-10">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
            </div>

            <!-- Pemasukan Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex flex-col items-center justify-center relative overflow-hidden group hover:shadow-md transition-shadow">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 dark:bg-green-900/20 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center mb-4 z-10">
                    <i class="fas fa-arrow-down text-xl"></i>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium z-10">Total Pemasukan</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 z-10">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>

            <!-- Pengeluaran Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex flex-col items-center justify-center relative overflow-hidden group hover:shadow-md transition-shadow">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 dark:bg-red-900/20 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center mb-4 z-10">
                    <i class="fas fa-arrow-up text-xl"></i>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium z-10">Total Pengeluaran</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 z-10">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Analytics Chart -->
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700 p-6 flex flex-col">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Analisis Pengeluaran</h3>
                @if(count($chartData['data']) > 0)
                    <div class="flex-1 relative w-full flex items-center justify-center">
                        <canvas id="expenseChart" class="w-full max-w-[250px] mx-auto"></canvas>
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center text-center py-10">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-700/50 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-chart-pie text-2xl text-gray-300 dark:text-gray-500"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada data pengeluaran untuk dianalisis bulan ini.</p>
                    </div>
                @endif
            </div>

            <!-- Transaction Table -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 flex flex-col">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Riwayat Transaksi</h3>
                </div>
                
                @if($transaksis->isEmpty())
                <div class="p-12 text-center flex-1 flex flex-col justify-center">
                    <div class="w-20 h-20 bg-gray-50 dark:bg-gray-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-receipt text-3xl text-gray-300 dark:text-gray-500"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">Belum ada transaksi</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Mulai catat pemasukan dan pengeluaran Anda.</p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 text-gray-400 dark:text-gray-500 text-xs uppercase tracking-wider">
                                <th class="p-4 font-bold">Tanggal</th>
                                <th class="p-4 font-bold">Kategori</th>
                                <th class="p-4 font-bold text-right">Jumlah</th>
                                <th class="p-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                            @foreach($transaksis as $transaksi)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $transaksi->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 truncate max-w-[120px]" title="{{ $transaksi->catatan }}">{{ $transaksi->catatan ?? '-' }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                        {{ $transaksi->kategori->nama }}
                                    </span>
                                </td>
                                <td class="p-4 text-right whitespace-nowrap">
                                    <div class="font-bold {{ $transaksi->tipe == 'pemasukan' ? 'text-green-500' : 'text-gray-700 dark:text-gray-200' }}">
                                        {{ $transaksi->tipe == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                    </div>
                                    <div class="text-[10px] uppercase font-bold mt-0.5 {{ $transaksi->tipe == 'pemasukan' ? 'text-green-400' : 'text-gray-400' }}">
                                        {{ $transaksi->tipe }}
                                    </div>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400 flex items-center justify-center hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                                            <i class="fas fa-pen text-xs"></i>
                                        </a>
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    @if(count($chartData['data']) > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('expenseChart').getContext('2d');
            
            // Generate pleasing colors dynamically
            const colors = [
                '#F4A261', '#E76F51', '#2A9D8F', '#E9C46A', '#264653',
                '#457B9D', '#A8DADC', '#1D3557', '#E63946', '#F1FAEE'
            ];
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($chartData['data']) !!},
                        backgroundColor: colors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563',
                                font: {
                                    family: "'Figtree', sans-serif",
                                    weight: '600'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endif
</x-app-layout>
