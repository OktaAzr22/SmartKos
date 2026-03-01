@props([
    'id' => 'animated-modal',
    'title' => 'Judul Modal',
    'size' => 'max-w-md',
])

<div id="{{ $id }}"
     class="fixed inset-0 bg-black/40 dark:bg-black/70 flex items-center justify-center z-40 hidden">

    <div id="{{ $id }}-content"
         class="bg-background dark:bg-dark-900 
                rounded-xl shadow-lg 
                w-full {{ $size }} mx-4 
                transform transition-all duration-300 scale-95 opacity-0">
        
        {{-- HEADER MODAL --}}
        <div class="flex justify-between items-center p-6 
                    border-b border-dark-200 dark:border-dark-700">
            
            <h3 class="text-lg font-semibold 
                       text-text dark:text-text">
                {{ $title }}
            </h3>

            <button type="button"
                class="text-dark-400 hover:text-dark-600 
                       dark:text-dark-400 dark:hover:text-dark-200
                       transition-colors close-modal"
                data-modal="{{ $id }}">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        {{-- BODY MODAL --}}
        <div class="p-6 text-dark-700 dark:text-dark-200">
            {{ $slot }}
        </div>
        
    </div>
</div>