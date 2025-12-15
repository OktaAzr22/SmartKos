<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DashboardPro</title>
    <script>
        if (
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
    @vite('resources/css/app.css')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      .no-scrollbar {
        scrollbar-width: none; 
        -ms-overflow-style: none;
      }

      .no-scrollbar::-webkit-scrollbar {
          display: none; 
      }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 dark:bg-slate-900 text-gray-900 dark:text-gray-100 font-inter">
  <div class="flex h-screen">
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">       
      @include('partials.header')

      <main class="flex-1 overflow-y-auto p-6">
        @yield('content')
      </main> 

    </div>
    
  </div>  
  <script src="{{ asset('js/app.js') }}"></script>
  @include('components.alert')
@stack('scripts')
</body>
</html>