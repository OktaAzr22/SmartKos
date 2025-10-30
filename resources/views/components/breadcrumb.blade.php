@props(['items' => []])

@php
    $breadcrumbs = $items ?: generate_breadcrumb();
    $last = array_key_last($breadcrumbs);
@endphp

<div class="mb-6 flex justify-between items-center">
    {{-- Judul halaman otomatis dari breadcrumb terakhir --}}
    <h3 class="text-lg font-semibold text-gray-900">
        {{ ucfirst($last) }}
    </h3>

    {{-- Breadcrumb Navigation --}}
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
            {{-- Home --}}
            <li>
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                        Home
                    </a>
                </div>
            </li>

            {{-- Dynamic Breadcrumb Items --}}
            @foreach ($breadcrumbs as $label => $url)
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                        @if ($label === $last)
                            <span class="ml-4 text-sm font-medium text-gray-700 font-semibold" aria-current="page">
                                {{ $label }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $label }}
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
</div>
