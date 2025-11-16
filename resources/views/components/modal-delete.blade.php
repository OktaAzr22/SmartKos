<div id="modal-delete"
    class="fixed inset-0 bg-black/50 dark:bg-black/60 flex items-center justify-center z-40 hidden">

    <div id="modal-delete-content"
        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-sm mx-4 
               transform transition-all duration-300 scale-95 opacity-0">

        <div class="p-6">

            <!-- Icon Warning -->
            <div class="flex items-center justify-center w-12 h-12 mx-auto 
                        bg-red-100 dark:bg-red-200/20 text-red-500 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>

            <!-- Title -->
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 text-center mb-2">
                Hapus Data?
            </h3>

            <!-- Description -->
            <p class="text-gray-600 dark:text-gray-300 text-center mb-6">
                Data yang dihapus tidak dapat dikembalikan
            </p>

            <!-- Buttons -->
            <div class="flex justify-center space-x-3">

                <!-- Cancel -->
                <button id="cancel-delete"
                    class="px-4 py-2 text-gray-600 dark:text-gray-300 
                           hover:text-gray-800 dark:hover:text-white 
                           font-medium transition-colors">
                    Batal
                </button>

                

                <!-- Delete Form -->
                <form id="delete-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-4 py-2 rounded-lg font-medium shadow-md transform transition-all
                               bg-gradient-to-r from-red-500 to-red-600 text-white
                               hover:from-red-600 hover:to-red-700 hover:scale-105">
                        Hapus
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
