@props([
    'href' => null,
    'text' => 'Cancel',
    'type' => 'button',
])

@php
    $baseClass = "px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200
                  bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600
                  rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700
                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                  flex items-center gap-2";
@endphp

@if($href)
    <a href="{{ $href }}"
       {{ $attributes->merge(['class' => $baseClass]) }}>
       
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
             class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
        </svg>

        {{ $text }}
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge(['class' => $baseClass]) }}>
            
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
             class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
        </svg>

        {{ $text }}
    </button>
@endif