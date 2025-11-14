          <x-modal-development />
          <div class="w-64 bg-white shadow-sm border-r border-gray-100 flex flex-col transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center shadow-sm">
                        <i class="fas fa-table text-white text-sm"></i>
                    </div>
                    <h1 class="text-xl font-bold text-gray-800">DashboardPro</h1>
                </div>
            </div>
            
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="menu-item flex items-center px-4 py-3 text-gray-500 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500' : '' }}">
                    <i class="fas fa-home mr-3"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                @php
                    $isKeuanganActive = request()->routeIs('keuangan.kategori.*') || 
                                       request()->routeIs('uang-saku.index') || 
                                       request()->routeIs('pengeluaran.index');
                @endphp
                <div>
                    <button class="submenu-btn flex items-center justify-between w-full px-4 py-3 text-gray-500 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors duration-200 {{ $isKeuanganActive ? 'bg-primary-50 text-primary-600' : '' }}" 
                            data-submenu="tables-submenu">
                        <div class="flex items-center">
                            <i class="fas fa-table mr-3"></i>
                            <span class="font-medium">Keuangan</span>
                        </div>
                        <i class="submenu-chevron fas fa-chevron-right text-xs transition-transform duration-300 {{ $isKeuanganActive ? 'rotate-90' : '' }}"></i>
                    </button>
                    <div id="tables-submenu" class="submenu transition-all duration-300 ml-4 {{ $isKeuanganActive ? 'max-h-96' : 'max-h-0 overflow-hidden' }}">
                        <a href="{{ route('keuangan.kategori.index') }}" class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('keuangan.kategori.*') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500 shadow-sm' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-circle text-xs mr-3 ml-1 {{ request()->routeIs('keuangan.kategori.*') ? 'text-primary-500' : 'text-gray-400' }}"></i>
                            <span>Kategori Keuangan</span>
                        </a>
                        <a href="{{ route('uang-saku.index') }}" class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('uang-saku.index') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500 shadow-sm' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-circle text-xs mr-3 ml-1 {{ request()->routeIs('uang-saku.index') ? 'text-primary-500' : 'text-gray-400' }}"></i>
                            <span>Pemasukan</span>
                        </a>
                        <a href="{{ route('pengeluaran.index') }}" class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('pengeluaran.index') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500 shadow-sm' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-circle text-xs mr-3 ml-1 {{ request()->routeIs('pengeluaran.index') ? 'text-primary-500' : 'text-gray-400' }}"></i>
                            <span>Pengeluaran</span>
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('rekap.index') }}" class="menu-item flex items-center px-4 py-3 text-gray-500 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors duration-200 {{ request()->routeIs('rekap.index') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500' : '' }}">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span class="font-medium">Rekap</span>
                </a>
                
                <button onclick="openDevModal()" class="menu-item flex items-center w-full px-4 py-3 text-gray-500 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors duration-200">
                    <i class="fas fa-users mr-3"></i>
                    <span class="font-medium">Anggaran</span>
                </button>
                
                {{-- @php
                    $isSettingsActive = request()->routeIs('settings.general') || 
                                       request()->routeIs('settings.security') || 
                                       request()->routeIs('settings.notifications');
                @endphp
                <div>
                    <button class="submenu-btn flex items-center justify-between w-full px-4 py-3 text-gray-500 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors duration-200 {{ $isSettingsActive ? 'bg-primary-50 text-primary-600' : '' }}" 
                            data-submenu="settings-submenu">
                        <div class="flex items-center">
                            <i class="fas fa-cog mr-3"></i>
                            <span class="font-medium">Settings</span>
                        </div>
                        <i class="submenu-chevron fas fa-chevron-right text-xs transition-transform duration-300 {{ $isSettingsActive ? 'rotate-90' : '' }}"></i>
                    </button>
                    <div id="settings-submenu" class="submenu transition-all duration-300 ml-4 {{ $isSettingsActive ? 'max-h-96' : 'max-h-0 overflow-hidden' }}">
                        <a href="#" class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('settings.general') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500 shadow-sm' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-circle text-xs mr-3 ml-1 {{ request()->routeIs('settings.general') ? 'text-primary-500' : 'text-gray-400' }}"></i>
                            <span>General</span>
                        </a>
                        <a href="#" class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('settings.security') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500 shadow-sm' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-circle text-xs mr-3 ml-1 {{ request()->routeIs('settings.security') ? 'text-primary-500' : 'text-gray-400' }}"></i>
                            <span>Security</span>
                        </a>
                        <a href="#" class="menu-item flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('settings.notifications') ? 'text-primary-600 bg-primary-50 border-l-4 border-primary-500 shadow-sm' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-circle text-xs mr-3 ml-1 {{ request()->routeIs('settings.notifications') ? 'text-primary-500' : 'text-gray-400' }}"></i>
                            <span>Notifications</span>
                        </a>
                    </div>
                </div> --}}
            </nav>
            
            {{-- <div class="p-4 border-t border-gray-100">
                <div class="bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl p-4 text-white shadow-md">
                    <h3 class="text-sm font-medium">Upgrade to Pro</h3>
                    <p class="text-xs opacity-90 mt-1">Get access to all features</p>
                    <button class="w-full mt-3 bg-white text-primary-600 hover:bg-gray-100 text-xs font-medium py-2 px-3 rounded-lg transition duration-150 shadow-sm">
                        Upgrade Now
                    </button>
                </div>
            </div> --}}
            
        </div>