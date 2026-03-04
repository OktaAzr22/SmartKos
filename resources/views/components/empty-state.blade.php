@props([
    'title' => 'Tidak ada data',
    'description' => 'Belum ada data yang tersedia',
    'minHeight' => '100vh',
])

<div {{ $attributes->merge([
    'class' => "mt-6 bg-white dark:bg-zinc-900 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm
               min-h-[$minHeight] flex items-center justify-center animate-fade-in-up"
]) }}>
    <div class="flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 bg-gray-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-inbox text-gray-400 dark:text-zinc-500 text-xl"></i>
        </div>

        <h3 class="text-lg font-semibold text-gray-900 dark:text-zinc-100 mb-1">
            {{ $title }}
        </h3>

        <p class="text-sm text-gray-500 dark:text-zinc-400 mb-6">
            {{ $description }}
        </p>

        {{ $slot }}
    </div>
</div>