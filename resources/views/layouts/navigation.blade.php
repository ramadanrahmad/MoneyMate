<!-- Mobile backdrop -->
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900/50 md:hidden" style="display: none;"></div>

<!-- Unified Sidebar Component -->
<div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-2xl md:shadow-none md:border-r md:border-gray-100 dark:md:border-gray-700 flex flex-col transition-transform duration-300 ease-in-out transform md:relative md:translate-x-0">
    
    <!-- Sidebar Header (Logo) -->
    <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100 dark:border-gray-700 shrink-0">
        <a href="{{ route('dashboard') }}" class="transform scale-75 origin-left">
            <x-application-logo />
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none w-8 h-8 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-full">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Sidebar Links -->
    <div class="flex-1 overflow-y-auto py-8 px-4 space-y-2">
        <div class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4 px-3">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#76C3FC]/10 text-[#76C3FC] dark:text-[#76C3FC]' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
            <i class="fas fa-home w-6 mr-2 text-lg {{ request()->routeIs('dashboard') ? 'text-[#76C3FC]' : 'text-gray-400 dark:text-gray-500' }}"></i>
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('transaksi.create') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('transaksi.create') ? 'bg-[#F4A261]/10 text-[#F4A261] dark:text-[#F4A261]' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
            <i class="fas fa-plus-circle w-6 mr-2 text-lg {{ request()->routeIs('transaksi.create') ? 'text-[#F4A261]' : 'text-gray-400 dark:text-gray-500' }}"></i>
            {{ __('Transaksi Baru') }}
        </a>
        
        <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-6"></div>
        <div class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4 px-3">Preferensi</div>
        
        <!-- Dark Mode Toggle Button -->
        <button @click="toggleTheme" class="w-full flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white">
            <template x-if="isDark">
                <div class="flex items-center w-full">
                    <i class="fas fa-sun w-6 mr-2 text-lg text-yellow-400"></i>
                    Mode Terang
                </div>
            </template>
            <template x-if="!isDark">
                <div class="flex items-center w-full">
                    <i class="fas fa-moon w-6 mr-2 text-lg text-indigo-400"></i>
                    Mode Gelap
                </div>
            </template>
        </button>
    </div>

    <!-- User Profile & Logout at Bottom -->
    <div class="p-5 border-t border-gray-100 dark:border-gray-700 shrink-0 bg-gray-50/50 dark:bg-gray-900/30">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#76C3FC] to-blue-500 text-white flex items-center justify-center font-bold shadow-md shrink-0">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3 flex-1 overflow-hidden">
                <p class="text-sm font-bold text-gray-800 dark:text-gray-100 truncate">{{ Auth::user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="text-xs text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-semibold transition-colors flex items-center group">
                        <i class="fas fa-sign-out-alt mr-1 group-hover:-translate-x-1 transition-transform"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
