<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keuangan Pribadi</title>
    @vite('resources/css/app.css')

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
        }

        .delay-200 { animation-delay: .2s }
        .delay-400 { animation-delay: .4s }
        .delay-600 { animation-delay: .6s }

        .text-shadow-soft {
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="text-center opacity-0 animate-fade-up">

       <h1 class="text-3xl font-bold text-gray-800 mb-3
           delay-200 opacity-0 animate-fade-up
           text-shadow-soft">
          Aplikasi Keuangan Pribadi
       </h1>

        <p class="text-gray-600 mb-6 delay-400 opacity-0 animate-fade-up">
            Catat pemasukan, pengeluaran, dan rekap bulanan secara mudah
        </p>

        <a href="{{ route('login') }}"
           class="inline-block px-4 py-3 bg-indigo-600 text-white rounded-sm
                  hover:bg-indigo-700 transition delay-600 opacity-0 animate-fade-up">
            Masuk
        </a>
    </div>
</body>
</html>