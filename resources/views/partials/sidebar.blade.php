<x-modal-development />

<div class="w-64 dark:bg-amber-200 bg-white shadow-sm border-r border-gray-200 flex flex-col transition-all duration-300">

    {{-- LOGO --}}
    <div class="p-6">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
                <i class="fas fa-table text-white text-sm"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800">DashboardPro</h1>
        </div>
    </div>
    
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar">

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}" 
           class="menu-item flex items-center px-4 py-3 rounded-lg transition-colors duration-200
           {{ request()->routeIs('dashboard') 
                ? 'text-indigo-600 bg-indigo-50 border-l-4 border-indigo-600' 
                : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
            <i class="fas fa-home mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        @php
            $isKeuanganActive = request()->routeIs('keuangan.kategori.*') || 
                               request()->routeIs('uang_saku.*') || 
                               request()->routeIs('pengeluaran.*');
        @endphp
        
        {{-- KEUANGAN --}}
        <div>
            <button 
                class="submenu-btn flex items-center justify-between w-full px-4 py-3 rounded-lg transition-colors duration-200
                {{ $isKeuanganActive 
                    ? 'bg-indigo-50 text-indigo-600' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}"
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
                
                {{-- KATEGORI --}}
                <a href="{{ route('keuangan.kategori.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200
                   {{ request()->routeIs('keuangan.kategori.*') 
                        ? 'text-indigo-600 bg-indigo-50 border-l-4 border-indigo-600' 
                        : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                    <span>Kategori Keuangan</span>
                </a>
                
                {{-- PEMASUKAN --}}
                <a href="{{ route('uang_saku.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200
                   {{ request()->routeIs('uang_saku.*') 
                        ? 'text-indigo-600 bg-indigo-50 border-l-4 border-indigo-600' 
                        : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                    <span>Pemasukan</span>
                </a>
                
                {{-- PENGELUARAN --}}
                <a href="{{ route('pengeluaran.index') }}" 
                   class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200
                   {{ request()->routeIs('pengeluaran.*') 
                        ? 'text-indigo-600 bg-indigo-50 border-l-4 border-indigo-600' 
                        : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
                    <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                    <span>Pengeluaran</span>
                </a>
            </div>
        </div>

        {{-- TEST --}}
        <a href="{{ route('test') }}"
           class="menu-item flex items-center px-4 py-3 rounded-lg transition-colors duration-200
           {{ request()->routeIs('test') 
                ? 'text-indigo-600 bg-indigo-50 border-l-4 border-indigo-600' 
                : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="font-medium">Test</span>
        </a>

        {{-- REKAP --}}
        <a href="{{ route('rekap.index') }}" 
           class="menu-item flex items-center px-4 py-3 rounded-lg transition-colors duration-200
           {{ request()->routeIs('rekap.*') 
                ? 'text-indigo-600 bg-indigo-50 border-l-4 border-indigo-600' 
                : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="font-medium">Rekap User</span>
        </a>

        {{-- ANGGARAN --}}
        <button onclick="openDevModal()" 
            class="menu-item flex items-center w-full px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-indigo-600 rounded-lg transition-colors duration-200">
            <i class="fas fa-users mr-3"></i>
            <span class="font-medium">Anggaran</span>
        </button>
        
        <div class="border-t border-gray-200 my-4"></div>
        
        {{-- INFO BOX --}}
        <div class="px-4 py-3 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-info-circle text-indigo-600 text-sm"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-600">Versi Aplikasi</p>
                    <p class="text-sm font-medium text-gray-800">1.0.0</p>
                </div>
            </div>
        </div>
    </nav>
    
    {{-- FOOTER --}}
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center justify-between text-xs text-gray-500">
            <span>&copy; 2026 DashboardPro</span>
            <span class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                Online
            </span>
        </div>
    </div>

</div>