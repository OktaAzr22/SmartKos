            <header class="bg-white border-b border-gray-200">
              <div class="flex items-center justify-between px-6 py-4">
                  <div class="relative">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <i class="fas fa-search text-gray-400"></i>
                      </div>
                      <input type="text" 
                            class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 
                                    focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm" 
                            placeholder="Search...">
                  </div>

                  <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                      <button class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                          <i class="fas fa-bell"></i>
                          <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                      </button>
                        <div class="relative">
                          <button id="profile-dropdown-btn" class="flex items-center space-x-3 focus:outline-none">
                              <div class="flex flex-col items-end">
                                  <span class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Tidak diketahui' }}</span>
                                  <span class="text-xs text-gray-500">-</span>
                              </div>
                              <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white font-semibold">
                                  JD
                              </div>
                              <i class="fas fa-chevron-down text-gray-500 text-xs transition-transform duration-200" id="profile-chevron"></i>
                          </button>

                          <!-- Dropdown Menu -->
                          <div id="profile-dropdown" class="profile-dropdown absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 z-10 border border-gray-100">
                              <div class="px-4 py-3 border-b border-gray-100">
                                  <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Tidak diketahui' }}</p>
                                  <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email ?? 'Tidak diketahui' }}</p>
                              </div>
                              <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                  <i class="fas fa-user mr-3 text-gray-400"></i>Profile
                              </a>
                              <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                  <i class="fas fa-cog mr-3 text-gray-400"></i>Settings
                              </a>
                              <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                  <i class="fas fa-bell mr-3 text-gray-400"></i>Notifications
                              </a>
                              <div class="border-t border-gray-100 my-1"></div>
                              <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                </button>
                            </form>
                              
                          </div>
                      </div>
                      
                  </div>
              </div>
            </header>