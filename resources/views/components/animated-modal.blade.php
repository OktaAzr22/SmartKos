@props([
    'id' => 'animated-modal',
    'title' => 'Judul Modal',
    'size' => 'max-w-md',
])

<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden">
    <div id="{{ $id }}-content"
         class="bg-white rounded-xl shadow-lg w-full {{ $size }} mx-4 transform transition-all duration-300 scale-95 opacity-0">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
            <button type="button"
                class="text-gray-400 hover:text-gray-500 transition-colors close-modal"
                data-modal="{{ $id }}">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
