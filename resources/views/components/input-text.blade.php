@props([
    'label' => null,
    'name',
    'value' => null,
])

@php
    $isRequired = $attributes->has('required');
    $hasError = $errors->has($name);
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">
            {{ $label }}
            @if ($isRequired)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input 
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge([
            'class' => 
                'w-full px-3 py-2 rounded-lg text-gray-900 dark:text-gray-100
                 bg-white dark:bg-gray-900 focus:outline-none focus:ring-2 ' . 
                ($hasError 
                    ? 'border-red-500 focus:ring-red-500' 
                    : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500')
        ]) }}
    >

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
