<div id="modal-development" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden flex justify-center items-center 
           bg-black/50 backdrop-blur-sm transition-opacity duration-300 ease-out opacity-0">
    <div class="relative w-full max-w-md p-4 transform scale-95 transition-transform duration-300 ease-out">
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    🚧 Fitur Sedang Tahap Pengembangan
                </h3>
                <button type="button" onclick="closeDevModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="p-6 text-center">
                <i class="fas fa-tools text-5xl text-yellow-500 mb-3 animate-bounce"></i>
                <p class="text-gray-700 dark:text-gray-300">
                    Maaf, fitur ini belum dapat digunakan. Kami sedang mengembangkannya agar bisa segera kamu nikmati.
                </p>
            </div>

            <div class="flex justify-center p-4 border-t dark:border-gray-700">
                <button type="button" onclick="closeDevModal()"
                    class="px-5 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const modalDev = document.getElementById('modal-development');
    const modalInner = modalDev.querySelector('.transform');

    function openDevModal() {
        modalDev.classList.remove('hidden');
        requestAnimationFrame(() => {
            modalDev.classList.remove('opacity-0');
            modalDev.classList.add('opacity-100');
            modalInner.classList.remove('scale-95');
            modalInner.classList.add('scale-100');
        });
    }

    function closeDevModal() {
        modalDev.classList.add('opacity-0');
        modalInner.classList.remove('scale-100');
        modalInner.classList.add('scale-95');
        setTimeout(() => modalDev.classList.add('hidden'), 300);
    }
</script>
