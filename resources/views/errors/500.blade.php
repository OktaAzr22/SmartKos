<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 | Kesalahan Server</title>
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

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center animate-fadeIn">
        <h1 class="text-9xl font-extrabold text-red-600">500</h1>
        <p class="text-2xl font-semibold text-gray-800 mt-4">Terjadi Kesalahan di Server</p>
        <p class="text-gray-500 mt-2 mb-6">
            Maaf, terjadi masalah di sisi server. Coba lagi beberapa saat lagi.
        </p>
        <a href="{{ url('/') }}" 
           class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
