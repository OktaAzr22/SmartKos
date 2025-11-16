@props([
    'label' => null,
    'name',
    'value' => null,
    'rows' => 4,
])

@php
    $isRequired = $attributes->has('required');
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">
            {{ $label }}
            @if ($isRequired)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' =>
                'w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100
                 focus:outline-none focus:ring-2 focus:ring-blue-500'
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
