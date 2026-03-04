@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-6 py-4 border-t border-gray-200 dark:border-zinc-700">
        <div class="text-sm text-gray-500 dark:text-zinc-400">
            Showing 
            <span class="font-medium text-gray-700 dark:text-zinc-300">{{ $paginator->firstItem() ?? 0 }}</span>
            to 
            <span class="font-medium text-gray-700 dark:text-zinc-300">{{ $paginator->lastItem() ?? 0 }}</span>
            of 
            <span class="font-medium text-gray-700 dark:text-zinc-300">{{ $paginator->total() }}</span>
            results
        </div>

        <div class="flex space-x-2">
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 text-sm font-medium text-gray-400 dark:text-zinc-500 bg-gray-100 dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-sm font-medium text-gray-500 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                    Previous
                </a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-1 text-sm text-gray-500 dark:text-zinc-400">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 text-sm font-medium text-white bg-primary-500 dark:bg-primary-600 border border-primary-500 dark:border-primary-600 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 text-sm font-medium text-gray-500 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-sm font-medium text-gray-500 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                    Next
                </a>
            @else
                <span class="px-3 py-1 text-sm font-medium text-gray-400 dark:text-zinc-500 bg-gray-100 dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </nav>
@endif