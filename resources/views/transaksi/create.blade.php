<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center w-full">
            <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-400 hover:text-gray-800 hover:shadow-sm border border-gray-100 transition-all mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-800 tracking-tight">
                {{ __('Tambah Transaksi Baru') }}
            </h2>
        </div>
    </x-slot>

    <div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Main Transaction Form -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-800"><i class="fas fa-file-invoice-dollar text-[#76C3FC] mr-2"></i> Detail Transaksi</h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Jenis / Tipe -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Transaksi</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-exchange-alt text-gray-400"></i>
                                            </div>
                                            <select name="tipe" class="pl-10 block w-full rounded-xl border-gray-200 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3" required>
                                                <option value="" disabled selected>Pilih Tipe</option>
                                                <option value="pemasukan">Pemasukan (Income)</option>
                                                <option value="pengeluaran">Pengeluaran (Expense)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Kategori -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-tags text-gray-400"></i>
                                            </div>
                                            <select name="kategori_id" class="pl-10 block w-full rounded-xl border-gray-200 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3" required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($kategoris->isEmpty())
                                            <p class="text-xs text-red-500 mt-1"><i class="fas fa-exclamation-circle"></i> Anda belum memiliki kategori, silakan tambah dulu di samping.</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Jumlah -->
                                <div x-data="{ 
                                    rawJumlah: '', 
                                    formattedJumlah: '',
                                    formatNumber() {
                                        // Hapus semua karakter yang bukan angka
                                        let val = this.formattedJumlah.replace(/\D/g, '');
                                        this.rawJumlah = val;
                                        
                                        // Tambahkan pemisah ribuan (titik)
                                        if (val) {
                                            this.formattedJumlah = new Intl.NumberFormat('id-ID').format(val);
                                        } else {
                                            this.formattedJumlah = '';
                                        }
                                    }
                                }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Nominal (Rp)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 font-medium">Rp</span>
                                        </div>
                                        <!-- Hidden input to send actual unformatted integer to backend -->
                                        <input type="hidden" name="jumlah" x-model="rawJumlah">
                                        <!-- Visible text input for user -->
                                        <input type="text" x-model="formattedJumlah" @input="formatNumber" class="pl-12 block w-full rounded-xl border-gray-200 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3 text-lg font-semibold text-gray-800" placeholder="0" required>
                                    </div>
                                </div>

                                <!-- Catatan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                                    <textarea name="catatan" rows="3" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-3" placeholder="Tuliskan keterangan detail transaksi..."></textarea>
                                </div>

                                <div class="pt-2">
                                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#F4A261] hover:bg-[#e09355] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F4A261] transition-colors">
                                        <i class="fas fa-save mr-2 mt-0.5"></i> Simpan Transaksi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Category Sidebar -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-800"><i class="fas fa-folder-plus text-[#F4A261] mr-2"></i> Kategori Baru</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-500 mb-4">Buat kategori baru untuk mengelompokkan transaksi Anda (mis: Makanan, Gaji, Transport).</p>
                            
                            <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-tag text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nama" class="pl-10 block w-full rounded-xl border-gray-200 shadow-sm focus:border-[#76C3FC] focus:ring focus:ring-[#76C3FC] focus:ring-opacity-50 transition-colors py-2.5" placeholder="Nama Kategori" required>
                                    </div>
                                </div>
                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                                    Tambah Kategori
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
