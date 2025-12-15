<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartKos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a2e0c0b0b3.js" crossorigin="anonymous"></script>
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

@keyframes fadeDown {
    from {
        opacity: 0;
        transform: translateY(-24px) scale(0.97);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.animate-fade-up {
    animation: fadeUp 0.8s ease-out forwards;
}

.animate-fade-down {
    animation: fadeDown 0.8s ease-out forwards;
}

.delay-200 { animation-delay: .2s }
.delay-400 { animation-delay: .4s }
.delay-600 { animation-delay: .6s }


    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 opacity-0 animate-fade-down">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6 opacity-0 animate-fade-down delay-200">Login ke SmartKos</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5 opacity-0 animate-fade-down delay-400">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" placeholder="contoh@email.com" required>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none pr-10 @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required>

                    <span onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer hover:text-blue-500">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6  opacity-0 animate-fade-down delay-600">
            © {{ date('Y') }} SmartKos. Semua hak dilindungi.
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

</body>
</html>
