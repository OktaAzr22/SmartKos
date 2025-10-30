   <x-modal-development />
   <div class="w-64 bg-white shadow-sm border-r border-gray-100 flex flex-col">
      <div class="p-6">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-sky-500 rounded-lg flex items-center justify-center">
            <i class="fas fa-table text-white text-sm"></i>
          </div>
          <h1 class="text-xl font-bold text-gray-800">SmartKos</h1>
        </div>
      </div>

      <nav class="flex-1 px-4 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="sidebar-item flex items-center px-4 py-3 rounded-lg 
                  {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="fas fa-home mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <div class="sidebar-group">
            <button class="sidebar-toggle flex items-center justify-between w-full px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-table mr-3"></i>
                    <span class="font-medium">Keuangan</span>
                </div>
                <i class="fas fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <div class="submenu ml-4 mt-1 
              {{ request()->routeIs('keuangan.kategori.*') || request()->routeIs('pengeluaran.*') || request()->routeIs('rekap.*') || request()->routeIs('uang-saku.*') ? 'open' : '' }}">
              
              <a href="{{ route('keuangan.kategori.index') }}"
                class="sidebar-item flex items-center px-4 py-2 text-sm rounded-lg 
                        {{ request()->routeIs('keuangan.kategori.*') ? 'active' : 'text-gray-700 hover:bg-gray-50' }}">
                  <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                  <span>Kategori</span>
              </a>

              <a href="{{ route('uang-saku.index') }}"
                  class="sidebar-item flex items-center px-4 py-2 text-sm rounded-lg 
                          {{ request()->routeIs('uang-saku.index') ? 'active' : 'text-gray-700 hover:bg-gray-50' }}">
                  <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                  <span>Pemasukan</span>
              </a>


              <a href="{{ route('pengeluaran.index') }}"
                class="sidebar-item flex items-center px-4 py-2 text-sm rounded-lg 
                        {{ request()->routeIs('pengeluaran.*') ? 'active' : 'text-gray-700 hover:bg-gray-50' }}">
                  <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                  <span>Pengeluaran</span>
              </a>

              <a href="{{ route('rekap.index') }}"
                class="sidebar-item flex items-center px-4 py-2 text-sm rounded-lg 
                        {{ request()->routeIs('rekap.*') ? 'active' : 'text-gray-700 hover:bg-gray-50' }}">
                  <i class="fas fa-circle text-xs mr-3 ml-1"></i>
                  <span>Rekap</span>
              </a>
            </div>
        </div>
        
        <button onclick="openDevModal()"
          class="sidebar-item flex items-center w-full text-left px-4 py-3 rounded-lg text-gray-500 hover:bg-gray-50 transition duration-150">
            <i class="fas fa-wallet mr-3"></i>
            <span class="font-medium">Anggaran</span>
        </button> 
      </nav>
      <div class="p-4 border-t border-gray-100">
        <div class="bg-primary-50 rounded-lg p-4">
          <h3 class="text-sm font-medium text-primary-700">Upgrade to Pro</h3>
          <p class="text-xs text-primary-600 mt-1">Get access to all features</p>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                    class="w-full mt-3 bg-primary-500 hover:bg-primary-600 text-white text-xs font-medium py-2 px-3 rounded-lg transition duration-150">
                Logout
            </button>
          </form>
        </div>
      </div>
    </div>