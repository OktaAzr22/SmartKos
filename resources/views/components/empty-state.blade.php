@props([
    'title' => 'Tidak ada data',
    'description' => 'Belum ada data yang tersedia',
    'minHeight' => '70vh',
])

<div {{ $attributes->merge([
    'class' => "mt-6 bg-white rounded-xl border border-gray-200 shadow-sm
               min-h-[$minHeight] flex items-center justify-center animate-fade-in-up"
]) }}>
    <div class="flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-inbox text-gray-400 text-xl"></i>
        </div>

        <h3 class="text-lg font-semibold text-gray-900 mb-1">
            {{ $title }}
        </h3>

        <p class="text-sm text-gray-500 mb-6">
            {{ $description }}
        </p>

        {{ $slot }}
    </div>
</div>
