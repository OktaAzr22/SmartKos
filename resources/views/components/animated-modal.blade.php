@props([
    'id' => 'animated-modal',
    'title' => 'Judul Modal',
    'size' => 'max-w-md',
])

<div id="{{ $id }}"
     class="fixed inset-0 bg-black/40 dark:bg-black/70 flex items-center justify-center z-40 hidden">

    <div id="{{ $id }}-content"
         class="bg-white dark:bg-gray-900
                rounded-xl shadow-lg 
                w-full {{ $size }} mx-4 
                transform transition-all duration-300 scale-95 opacity-0">
        
        <!-- HEADER MODAL -->
        <div class="flex justify-between items-center p-6 
                    border-b border-gray-200 dark:border-gray-700">
            
            <h3 class="text-lg font-semibold 
                       text-gray-900 dark:text-white">
                {{ $title }}
            </h3>

            <button type="button"
                class="text-gray-400 hover:text-gray-600 
                       dark:text-gray-400 dark:hover:text-gray-200
                       transition-colors close-modal"
                data-modal="{{ $id }}">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- BODY MODAL -->
        <div class="p-6 text-gray-700 dark:text-gray-300">
            {{ $slot }}
        </div>
        
    </div>
</div>