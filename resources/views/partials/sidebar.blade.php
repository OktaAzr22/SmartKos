<x-modal-development />

<div class="w-64 dark:bg-zinc-900 bg-white shadow-sm border-r border-gray-200 dark:border-zinc-700 flex flex-col transition-all duration-300">

    <div class="p-6">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
                <i class="fas fa-table text-white text-sm"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800 dark:text-zinc-100">DashboardPro</h1>
        </div>
    </div>
    
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar">
        <a href="{{ route('dashboard') }}" 
           class="menu-item flex items-center px-4 py-3 rounded-lg transition-colors duration-200
           {{ request()->routeIs('dashboard') 
                ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 border-l-4 border-indigo-600 dark:border-indigo-400' 
                : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
            <i class="fas fa-home mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        @php
            $isKeuanganActive = request()->routeIs('keuangan.kategori.*') || 
                               request()->routeIs('uang_saku.*') || 
                               request()->routeIs('pengeluaran.*');
        @endphp
        
        <div>
            <button 
                class="submenu-btn flex items-center justify-between w-full px-4 py-3 rounded-lg transition-colors duration-200
                {{ $isKeuanganActive 
                    ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' 
                    : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}"
                data-submenu="keuangan-submenu">

                <div class="flex items-center">
                    <i class="fas fa-table mr-3"></i>
                    <span class="font-medium">Keuangan</span>
                </div>

                <i class="submenu-chevron fas fa-chevron-right text-xs transition-transform duration-300
                    {{ $isKeuanganActive ? 'rotate-90' : '' }}"></i>
            </button>
            
            <div id="keuangan-submenu" 
                class="submenu ml-4 mt-1 space-y-1 transition-all duration-300
                {{ $isKeuanganActive 
                    ? 'max-h-96 opacity-100' 
                    : 'max-h-0 opacity-0 overflow-hidden' }}">
                
                <a href="{{ route('keuangan.kategori.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200
                   {{ request()->routeIs('keuangan.kategori.*') 
                        ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 border-l-4 border-indigo-600 dark:border-indigo-400' 
                        : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                    <span>Kategori Keuangan</span>
                </a>
                
                <a href="{{ route('uang_saku.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200
                   {{ request()->routeIs('uang_saku.*') 
                        ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 border-l-4 border-indigo-600 dark:border-indigo-400' 
                        : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                    <span>Pemasukan</span>
                </a>
                
                <a href="{{ route('pengeluaran.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200
                   {{ request()->routeIs('pengeluaran.*') 
                        ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 border-l-4 border-indigo-600 dark:border-indigo-400' 
                        : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                    <span>Pengeluaran</span>
                </a>
            </div>
        </div>

        <a href="{{ route('test') }}"
           class="menu-item flex items-center px-4 py-3 rounded-lg transition-colors duration-200
           {{ request()->routeIs('test') 
                ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 border-l-4 border-indigo-600 dark:border-indigo-400' 
                : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="font-medium">Test</span>
        </a>

        <a href="{{ route('rekap.index') }}" 
           class="menu-item flex items-center px-4 py-3 rounded-lg transition-colors duration-200
           {{ request()->routeIs('rekap.*') 
                ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 border-l-4 border-indigo-600 dark:border-indigo-400' 
                : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="font-medium">Rekap User</span>
        </a>

        <button onclick="openDevModal()" 
            class="menu-item flex items-center w-full px-4 py-3 text-gray-600 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800/50 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-colors duration-200">
            <i class="fas fa-users mr-3"></i>
            <span class="font-medium">Anggaran</span>
        </button>
        
        <div class="border-t border-gray-200 dark:border-zinc-700 my-4"></div>
        
        <div class="px-4 py-3 bg-gray-50 dark:bg-zinc-800/50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                    <i class="fas fa-info-circle text-indigo-600 dark:text-indigo-400 text-sm"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-600 dark:text-zinc-400">Versi Aplikasi</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-zinc-200">1.0.0</p>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="p-4 border-t border-gray-200 dark:border-zinc-700">
        <div class="text-center text-xs text-gray-500 dark:text-zinc-400">
            &copy; 2026 SmartKost
        </div>
    </div>

</div>