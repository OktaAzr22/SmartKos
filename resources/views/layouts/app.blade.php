<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SmartKos' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="text-xl font-semibold text-blue-600">SmartKos</div>
        <div class="flex items-center space-x-6">
            <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            <a href="{{ route('kategori.index') }}" class="hover:text-blue-600">Kategori</a>
            <a href="{{ route('pengeluaran.index') }}" class="hover:text-blue-600">Pengeluaran</a>
            <a href="{{ route('uang-saku.create') }}" class="hover:text-blue-600">Saldo</a>
            <a href="{{ route('rekap.index') }}">Rekap</a>

            <a href="{{ route('profile') }}" class="hover:text-blue-600">Profil</a>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Konten Halaman -->
    <main class="p-6">
        @yield('content')
    </main>
<script>
    // --- Modal Animation Helpers ---
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId + '-content');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId + '-content');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // --- Event delegation untuk tombol close modal ---
    document.addEventListener('click', function (e) {
        if (e.target.closest('.close-modal')) {
            const id = e.target.closest('.close-modal').dataset.modal;
            hideModal(id);
        }
    });
</script>
</body>
</html>
