<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.head')
</head>
<body class="bg-gray-50">
    <!-- Alert Area -->
    <div id="alert-container" class="fixed top-4 right-4 z-50 w-80 space-y-3"></div>

    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Modals -->
    @include('components.modal-form')
    @include('components.modal-delete')

    <!-- Scripts -->
    <script>
        // Data untuk aplikasi
        let dataPengeluaran = @json($pengeluaran ?? []);
        let currentSort = { field: 'tanggal', direction: 'desc' };
        let deleteId = null;

        // Format tanggal
        function formatTanggal(tanggal) {
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            return new Date(tanggal).toLocaleDateString('id-ID', options);
        }

        // Format mata uang
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Dapatkan class CSS untuk kategori
        function getCategoryClass(kategori) {
            const classes = {
                'Makan & Minum': 'bg-blue-100 text-blue-800 border border-blue-200',
                'Transportasi': 'bg-green-100 text-green-800 border border-green-200',
                'Hiburan': 'bg-purple-100 text-purple-800 border border-purple-200',
                'Kebutuhan Pokok': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                'Lainnya': 'bg-indigo-100 text-indigo-800 border border-indigo-200'
            };
            return classes[kategori] || 'bg-gray-100 text-gray-800 border border-gray-200';
        }

        // Tampilkan modal dengan animasi
        function showModal(modal, content) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Sembunyikan modal dengan animasi
        function hideModal(modal, content) {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Helper functions
        function hideAllErrors() {
            document.querySelectorAll('[id^="error-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }

        function showAlert(message, type) {
            const alertId = 'alert-' + Date.now();
            const alert = document.createElement('div');
            alert.id = alertId;
            alert.className = `p-4 rounded-lg shadow-md animate-slide-down ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
            
            alert.innerHTML = `
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                        <span>${message}</span>
                    </div>
                    <button class="text-gray-500 hover:text-gray-700 close-alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                    <div class="h-1 rounded-full ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} animate-progress"></div>
                </div>
            `;
            
            document.getElementById('alert-container').appendChild(alert);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.classList.remove('animate-slide-down');
                    alertElement.classList.add('animate-slide-up');
                    setTimeout(() => {
                        if (alertElement.parentNode) {
                            alertElement.parentNode.removeChild(alertElement);
                        }
                    }, 300);
                }
            }, 5000);
            
            // Close button functionality
            alert.querySelector('.close-alert').addEventListener('click', () => {
                alert.classList.remove('animate-slide-down');
                alert.classList.add('animate-slide-up');
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            });
        }

        // Inisialisasi saat DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal hari ini sebagai default di form
            const today = new Date().toISOString().split('T')[0];
            if (document.getElementById('tanggal')) {
                document.getElementById('tanggal').value = today;
            }
        });
    </script>

    <!-- Script tambahan dari section scripts -->
    @yield('scripts')
</body>
</html>