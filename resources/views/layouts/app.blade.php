<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SmartKos' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-item.active {
            background-color: #f0f9ff;
            border-left: 4px solid #0ea5e9;
            color: #0369a1;
        }

        .sidebar-item.active i {
            color: #0ea5e9;
        }
        .status-active {
            background-color: #f0f9ff;
            color: #0ea5e9;
        }

        .status-pending {
            background-color: #fffbeb;
            color: #f59e0b;
        }

        .status-cancel {
            background-color: #fef2f2;
            color: #ef4444;
        }


        /* ====== SUBMENU ANIMATION ====== */
        .submenu {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .submenu.open {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0);
        }

        .rotate-90 {
            transform: rotate(90deg);
        }

        /* Animasi untuk profile dropdown */
        .profile-dropdown {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
            transition: opacity 0.2s ease, transform 0.2s ease;
            pointer-events: none;
        }
        
        .profile-dropdown.show {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        
    </style>
</head>
<body class="bg-gray-50 font-inter">
    
  <div class="flex h-screen">
    @include('components.sidebar')
    <div class="flex-1 flex flex-col overflow-hidden">
      @include('components.header')
      <main class="flex-1 overflow-y-auto p-6">
        @yield('content')
       <footer class="mt-8 border-t border-gray-200 bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
        <div class="mb-2 sm:mb-0 text-center sm:text-left">
            © {{ date('Y') }} 
            <span class="text-primary-600 font-semibold">SmartKos</span>. 
            All rights reserved.
        </div>

        <div class="flex items-center space-x-4">
            <a href="#" class="hover:text-primary-600 transition-colors">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="hover:text-primary-600 transition-colors">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="hover:text-primary-600 transition-colors">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="hover:text-primary-600 transition-colors">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
    </div>
</footer>

      </main>
    </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
  @include('components.alert')
</body>
</html>