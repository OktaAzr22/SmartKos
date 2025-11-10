<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeIn {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center animate-fadeIn">
        <h1 class="text-9xl font-extrabold text-green-600">404</h1>
        <p class="text-2xl font-semibold text-gray-800 mt-4">Halaman Tidak Ditemukan</p>
        <p class="text-gray-500 mt-2 mb-6">
            Sepertinya alamat yang kamu tuju tidak tersedia atau sudah dipindahkan.
        </p>
        <a href="{{ url('/') }}" 
           class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
