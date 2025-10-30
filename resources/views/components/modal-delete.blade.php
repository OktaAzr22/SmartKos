<div id="modal-delete"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-sm mx-4 transform transition-all duration-300 scale-95 opacity-0"
        id="modal-delete-content">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Hapus Data?</h3>
            <p class="text-gray-600 text-center mb-6">Data yang dihapus tidak dapat dikembalikan</p>
            <div class="flex justify-center space-x-3">
                <button id="cancel-delete"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    Batal
                </button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all font-medium transform hover:scale-105 shadow-md">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
