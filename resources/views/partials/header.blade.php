<header class="bg-white dark:bg-dark-900 border-b border-gray-200 dark:border-dark-700 shadow-sm transition-colors duration-300">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 dark:text-dark-500"></i>
            </div>
            <input type="text" 
                    class="block w-64 pl-10 pr-3 py-2 border border-gray-300 dark:border-dark-600 rounded-lg 
                          bg-gray-50 dark:bg-dark-800 
                          text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-dark-500
                          focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary 
                          text-sm transition duration-150" 
                    placeholder="Search...">
        </div>

        <div class="flex items-center space-x-4">
            <button class="relative p-2 text-gray-500 hover:text-primary-600 focus:outline-none transition-colors duration-200">
                <i class="fas fa-bell"></i>
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <div class="relative">
                <button id="profile-dropdown-btn" class="flex items-center space-x-3 focus:outline-none group">
                    <div class="flex flex-col items-end">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->full_name ?? 'Guest' }}</span>
                        <span class="text-xs text-gray-500 dark:text-dark-400">{{ ucfirst($status) }}</span>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-r from-primary to-primary-600 dark:from-primary dark:to-primary-600 rounded-full flex items-center justify-center text-white font-semibold shadow-sm">
                        @if(Auth::user() && Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" 
                                    alt="Profile" 
                                    class="w-full h-full object-cover rounded-full">
                        @else
                            {{ strtoupper(substr(Auth::user()->full_name ?? 'JD', 0, 2)) }}
                        @endif
                    </div>
                    <i class="fas fa-chevron-down text-gray-500 dark:text-dark-400 text-xs transition-transform duration-200 group-hover:text-primary dark:group-hover:text-primary" id="profile-chevron"></i>
                </button>

                <div id="profile-dropdown" class="absolute right-0 mt-2 w-56 bg-white dark:bg-dark-800 rounded-xl shadow-lg dark:shadow-dark-lg py-2 z-10 border border-gray-100 dark:border-dark-700 opacity-0 invisible transition-all duration-200 transform -translate-y-2">
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-dark-700">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->full_name ?? 'Guest' }}</p>
                        <p class="text-sm text-gray-500 dark:text-dark-400 truncate">{{ Auth::user()->email ?? 'Not Found' }}</p>
                    </div>
                    <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-dark-700 hover:text-primary dark:hover:text-primary transition-colors duration-150">
                        <i class="fas fa-user mr-3 text-gray-400 dark:text-dark-500"></i>Profile
                    </a>
                    
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-dark-700 hover:text-primary dark:hover:text-primary transition-colors duration-150">
                        <i class="fas fa-cog mr-3 text-gray-400 dark:text-dark-500"></i>Settings
                    </a>
                    
                    <div class="px-4 py-2 flex items-center justify-between border-t border-gray-100 dark:border-dark-700">
                        <span class="text-sm text-gray-600 dark:text-gray-300">Dark Mode</span>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="dark-mode-toggle" class="sr-only peer" 
                                   @if(request()->cookie('theme') == 'dark' || session('theme') == 'dark') checked @endif>
                            <div class="w-11 h-6 bg-gray-200 dark:bg-dark-600 rounded-full peer
                                        peer-checked:bg-primary
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:w-5 after:h-5 after:bg-white after:border after:border-gray-300 dark:after:border-dark-500
                                        after:rounded-full after:transition-all
                                        peer-checked:after:translate-x-full peer-checked:after:border-white
                                        dark:peer-checked:bg-primary">
                            </div>
                        </label>
                    </div>

                    <div class="border-t border-gray-100 dark:border-dark-700 my-1"></div>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-danger hover:bg-danger-50 dark:hover:bg-danger-900/20 transition-colors duration-150">
                            <i class="fas fa-sign-out-alt mr-3"></i>Logout
                        </button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</header>