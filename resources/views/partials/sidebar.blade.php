<x-modal-development />
<div class="w-64 bg-white dark:bg-dark-900 shadow-sm dark:shadow-dark-sm border-r border-gray-100 dark:border-dark-800 flex flex-col transition-all duration-300">
    <div class="p-6">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-primary to-primary-600 dark:from-primary dark:to-primary-600 rounded-lg flex items-center justify-center shadow-sm">
                <i class="fas fa-table text-white text-sm"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">DashboardPro</h1>
        </div>
    </div>
    
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar">
        <a href="{{ route('dashboard') }}" 
           class="menu-item flex items-center px-4 py-3 text-gray-500 dark:text-dark-400 
                  hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary 
                  rounded-lg transition-colors duration-200 
                  {{ request()->routeIs('dashboard') ? '!text-primary !bg-primary-50 dark:!bg-primary-500/10 dark:!text-primary border-l-4 border-primary' : '' }}">
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
                class="submenu-btn flex items-center justify-between w-full px-4 py-3
                    text-gray-500 dark:text-dark-400
                    hover:bg-primary-50 dark:hover:bg-dark-800
                    hover:text-primary-600 dark:hover:text-primary
                    rounded-lg transition-colors duration-200
                    {{ $isKeuanganActive 
                        ? 'bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary' 
                        : '' }}"
                data-submenu="keuangan-submenu">

                <div class="flex items-center">
                    <i class="fas fa-table mr-3"></i>
                    <span class="font-medium">Keuangan</span>
                </div>

                <i class="submenu-chevron fas fa-chevron-right text-xs transition-transform duration-300
                    {{ $isKeuanganActive ? 'rotate-90' : '' }}"></i>
            </button>
            
            <div id="keuangan-submenu" class="submenu ml-4 mt-1 space-y-1 transition-all duration-300 
                      {{ $isKeuanganActive 
                            ? 'max-h-96 opacity-100' 
                            : 'max-h-0 opacity-0 overflow-hidden' }}">
                
                <a href="{{ route('keuangan.kategori.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('keuangan.kategori.*') 
                              ? '!text-primary !bg-primary-50 dark:!bg-primary-500/10 border-l-4 border-primary' 
                              : 'text-gray-700 dark:text-dark-300 hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1 
                          {{ request()->routeIs('keuangan.kategori.*') ? '!text-primary' : 'text-gray-400 dark:text-dark-500' }}"></i>
                    <span>Kategori Keuangan</span>
                </a>
                
                <!-- Pemasukan -->
                <a href="{{ route('uang_saku.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('uang_saku.*') 
                              ? '! !bg-primary-50 dark:!bg-primary-500/10 border-l-4 border-primary' 
                              : 'text-gray-700 dark:text-dark-300 hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1 
                          {{ request()->routeIs('uang_saku.*') ? '!text-primary' : 'text-gray-400 dark:text-dark-500' }}"></i>
                    <span>Pemasukan</span>
                </a>
                
                <!-- Pengeluaran -->
                <a href="{{ route('pengeluaran.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('pengeluaran.*') 
                              ? '!text-primary !bg-primary-50 dark:!bg-primary-500/10 border-l-4 border-primary' 
                              : 'text-gray-700 dark:text-dark-300 hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1 
                          {{ request()->routeIs('pengeluaran.*') ? '!text-primary' : 'text-gray-400 dark:text-dark-500' }}"></i>
                    <span>Pengeluaran</span>
                </a>
            </div>
        </div>

        <!-- Test Menu -->
        <a href="{{ route('test') }}"
           class="menu-item flex items-center px-4 py-3 text-gray-500 dark:text-dark-400 
                  hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary 
                  rounded-lg transition-colors duration-200 
                  {{ request()->routeIs('test') ? '!text-primary !bg-primary-50 dark:!bg-primary-500/10 dark:!text-primary border-l-4 border-primary' : '' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="font-medium">Test</span>
        </a>

        <!-- Rekap User Menu -->
        <a href="{{ route('rekap.index') }}" 
           class="menu-item flex items-center px-4 py-3 text-gray-500 dark:text-dark-400 
                  hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary 
                  rounded-lg transition-colors duration-200 
                  {{ request()->routeIs('rekap.*') ? '!text-primary !bg-primary-50 dark:!bg-primary-500/10 dark:!text-primary border-l-4 border-primary' : '' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="font-medium">Rekap User</span>
        </a>

        <!-- Anggaran Menu (Modal) -->
        <button onclick="openDevModal()" 
                class="menu-item flex items-center w-full px-4 py-3 text-gray-500 dark:text-dark-400 
                       hover:bg-primary-50 dark:hover:bg-dark-800 hover:text-primary dark:hover:text-primary 
                       rounded-lg transition-colors duration-200">
            <i class="fas fa-users mr-3"></i>
            <span class="font-medium">Anggaran</span>
        </button>
        
        <!-- Divider -->
        <div class="border-t border-gray-100 dark:border-dark-800 my-4"></div>
        
        <!-- Info Box -->
        <div class="px-4 py-3 bg-gray-50 dark:bg-dark-800 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-primary/20 dark:bg-primary/10 flex items-center justify-center">
                    <i class="fas fa-info-circle text-primary text-sm"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-600 dark:text-dark-400">Versi Aplikasi</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">1.0.0</p>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Footer Sidebar -->
    <div class="p-4 border-t border-gray-100 dark:border-dark-800">
        <div class="flex items-center justify-between text-xs text-gray-400 dark:text-dark-500">
            <span>&copy; 2026 DashboardPro</span>
            <span class="flex items-center">
                <span class="w-2 h-2 bg-success rounded-full mr-1"></span>
                Online
            </span>
        </div>
    </div>
</div>