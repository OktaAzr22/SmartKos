@props([
    'label' => null,
    'name',
    'prefix' => null,
    'value' => null
])

@php
    $isRequired = $attributes->has('required');
    $hasError = $errors->has($name);
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }}
            @if($isRequired)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">

        @if ($prefix)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 dark:text-gray-400">{{ $prefix }}</span>
        </div>
        @endif

        <input 
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $attributes->merge([
                'class' => 
                    'w-full ' . ($prefix ? 'pl-12' : 'pl-3') . ' pr-3 py-2 rounded-lg 
                     bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 
                     focus:ring-2 ' .
                    ($hasError
                        ? 'border-red-500 focus:ring-red-500'
                        : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500')
            ]) }}
        >
    </div>

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
