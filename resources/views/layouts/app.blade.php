<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DashboardPro</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-rose-800 dark:bg-slate-900 font-inter">
  <div class="flex h-screen">
    @include('partials.sidebar')
    <div class="flex-1 flex flex-col overflow-hidden">       
      @include('partials.header')
      <main class="flex-1 overflow-y-auto p-6">
        @yield('content')
        @include('partials.footer')
      </main>      
    </div>
  </div>  
  <script src="{{ asset('js/app.js') }}"></script>
  @include('components.alert')
@stack('scripts')
</body>
</html>