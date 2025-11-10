<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 | Sesi Kedaluwarsa</title>
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
        <h1 class="text-9xl font-extrabold text-purple-600">419</h1>
        <p class="text-2xl font-semibold text-gray-800 mt-4">Sesi Kedaluwarsa</p>
        <p class="text-gray-500 mt-2 mb-6">
            Sesi kamu telah berakhir. Silakan login kembali untuk melanjutkan.
        </p>
        <a href="{{ route('login') }}" 
           class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
            Login Ulang
        </a>
    </div>
</body>
</html>
