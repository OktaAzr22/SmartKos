@props([
    'label' => null,
    'name',
    'options' => [],
    'value' => null,
])

@php
    $isRequired = $attributes->has('required');
@endphp

<div class="mb-4">
    @if ($label)
        <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">
            {{ $label }}
            @if ($isRequired)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge([
            'class' =>
                'w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100
                 focus:outline-none focus:ring-2 focus:ring-blue-500'
        ]) }}
    >
        <option value="">-- Pilih --</option>

        @foreach ($options as $key => $text)
            <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
