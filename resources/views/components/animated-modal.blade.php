@props([
    'id' => 'animated-modal',
    'title' => 'Judul Modal',
    'size' => 'max-w-md',
])

<div id="{{ $id }}"
     class="fixed inset-0 bg-black/40 dark:bg-black/70 flex items-center justify-center z-40 hidden">

    <div id="{{ $id }}-content"
         class="bg-white dark:bg-zinc-900
                rounded-xl shadow-lg dark:shadow-zinc-900/50
                w-full {{ $size }} mx-4 
                transform transition-all duration-300 scale-95 opacity-0">
        
        <!-- HEADER MODAL -->
        <div class="flex justify-between items-center p-6 
                    border-b border-gray-200 dark:border-zinc-700">
            
            <h3 class="text-lg font-semibold 
                       text-gray-900 dark:text-zinc-100">
                {{ $title }}
            </h3>

            <button type="button"
                class="text-gray-400 hover:text-gray-600 
                       dark:text-zinc-400 dark:hover:text-zinc-200
                       transition-colors close-modal"
                data-modal="{{ $id }}">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- BODY MODAL -->
        <div class="p-6 text-gray-700 dark:text-zinc-300">
            {{ $slot }}
        </div>
        
    </div>
</div>