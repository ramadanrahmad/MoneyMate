<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-extrabold text-2xl text-gray-800 tracking-tight">
                {{ __('Dashboard Keuangan') }}
            </h2>
            <a href="{{ route('transaksi.create') }}" class="inline-flex items-center px-4 py-2.5 bg-[#F4A261] rounded-xl font-bold text-sm text-white hover:bg-[#e09355] focus:outline-none focus:ring-2 focus:ring-[#F4A261] focus:ring-offset-2 transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i> Tambah Transaksi
            </a>
        </div>
    </x-slot>

    <div>
            
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Saldo Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center relative overflow-hidden group hover:shadow-md transition-shadow">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 z-10">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium z-10">Sisa Saldo</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-1 z-10">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>

                <!-- Pemasukan Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center relative overflow-hidden group hover:shadow-md transition-shadow">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4 z-10">
                        <i class="fas fa-arrow-down text-xl"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium z-10">Total Pemasukan</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-1 z-10">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>

                <!-- Pengeluaran Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center relative overflow-hidden group hover:shadow-md transition-shadow">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4 z-10">
                        <i class="fas fa-arrow-up text-xl"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium z-10">Total Pengeluaran</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-1 z-10">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Transaction Table -->
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Transaksi</h3>
                </div>
                
                @if($transaksis->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-receipt text-3xl text-gray-400"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-1">Belum ada transaksi</h4>
                    <p class="text-gray-500">Mulai catat pemasukan dan pengeluaran Anda.</p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-100 text-gray-500 text-sm uppercase tracking-wider">
                                <th class="p-4 font-medium">Tanggal</th>
                                <th class="p-4 font-medium">Kategori</th>
                                <th class="p-4 font-medium">Tipe</th>
                                <th class="p-4 font-medium text-right">Jumlah</th>
                                <th class="p-4 font-medium">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($transaksis as $transaksi)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="p-4 text-gray-600 text-sm whitespace-nowrap">
                                    {{ $transaksi->created_at->format('d M Y') }}
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $transaksi->kategori->nama }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($transaksi->tipe == 'pemasukan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            <i class="fas fa-arrow-down mr-1.5 text-[10px]"></i> Pemasukan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <i class="fas fa-arrow-up mr-1.5 text-[10px]"></i> Pengeluaran
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right whitespace-nowrap">
                                    <span class="font-semibold {{ $transaksi->tipe == 'pemasukan' ? 'text-green-600' : 'text-gray-800' }}">
                                        {{ $transaksi->tipe == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-500 text-sm">
                                    {{ $transaksi->catatan ?? '-' }}
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
</x-app-layout>
