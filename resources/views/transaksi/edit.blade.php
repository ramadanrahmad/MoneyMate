<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center w-full">
            <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 dark:text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 hover:shadow-sm border border-gray-100 dark:border-gray-700 transition-all mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-100 tracking-tight">
                {{ __('Edit Transaksi') }}
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto">
            
            <!-- Edit Transaction Form -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100"><i class="fas fa-pen text-[#76C3FC] mr-2"></i> Perbarui Detail Transaksi</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Jenis / Tipe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe Transaksi</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-exchange-alt text-gray-400"></i>
                                    </div>
                                    <select name="tipe" class="pl-10 block w-full rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3" required>
                                        <option value="pemasukan" {{ $transaksi->tipe === 'pemasukan' ? 'selected' : '' }}>Pemasukan (Income)</option>
                                        <option value="pengeluaran" {{ $transaksi->tipe === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran (Expense)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tags text-gray-400"></i>
                                    </div>
                                    <select name="kategori_id" class="pl-10 block w-full rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3" required>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ $transaksi->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($kategoris->isEmpty())
                                    <p class="text-xs text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> Anda belum memiliki kategori, silakan tambah dulu.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div x-data="{ 
                            rawJumlah: '{{ $transaksi->jumlah }}', 
                            formattedJumlah: '{{ number_format($transaksi->jumlah, 0, ',', '.') }}',
                            formatNumber() {
                                let val = this.formattedJumlah.replace(/\D/g, '');
                                this.rawJumlah = val;
                                
                                if (val) {
                                    this.formattedJumlah = new Intl.NumberFormat('id-ID').format(val);
                                } else {
                                    this.formattedJumlah = '';
                                }
                            }
                        }">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Nominal (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">Rp</span>
                                </div>
                                <!-- Hidden input to send actual unformatted integer to backend -->
                                <input type="hidden" name="jumlah" x-model="rawJumlah">
                                <!-- Visible text input for user -->
                                <input type="text" x-model="formattedJumlah" @input="formatNumber" class="pl-12 block w-full rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3 text-lg font-semibold" placeholder="0" required>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan (Opsional)</label>
                            <textarea name="catatan" rows="3" class="block w-full rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3" placeholder="Tuliskan keterangan detail transaksi...">{{ $transaksi->catatan }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#F4A261] hover:bg-[#e09355] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F4A261] transition-colors">
                                <i class="fas fa-save mr-2 mt-0.5"></i> Perbarui Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
