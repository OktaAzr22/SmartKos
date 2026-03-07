@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-6 py-4 border-t border-gray-200 dark:border-zinc-700">
        <div class="text-sm text-gray-500 dark:text-zinc-400">
            <span class="font-medium text-gray-700 dark:text-zinc-300">{{ $paginator->firstItem() ?? 0 }}</span>
            <span class="mx-1">-</span>
            <span class="font-medium text-gray-700 dark:text-zinc-300">{{ $paginator->lastItem() ?? 0 }}</span>
            <span class="mx-1">dari</span>
            <span class="font-medium text-gray-700 dark:text-zinc-300">{{ $paginator->total() }}</span>
        </div>

        <div class="flex space-x-2">

            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 text-sm font-medium text-gray-400 dark:text-zinc-500 bg-gray-100 dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-sm font-medium text-gray-500 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                    Previous
                </a>
            @endif

            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="px-2 py-1 text-sm text-gray-500 dark:text-zinc-400">
                        ...
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span class="px-3 py-1 text-sm font-medium text-white 
                                        bg-indigo-600 border border-indigo-600 rounded-lg">
                                {{ $page }}
                            </span>

                        @elseif (
                            $page == 1 ||
                            $page == $paginator->lastPage() ||
                            ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1)
                        )

                            <a href="{{ $url }}"
                            class="px-3 py-1 text-sm font-medium
                                    text-gray-500 dark:text-zinc-300
                                    bg-white dark:bg-zinc-800
                                    border border-gray-300 dark:border-zinc-700
                                    rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                                {{ $page }}
                            </a>

                        @elseif (
                            $page == $paginator->currentPage() - 2 ||
                            $page == $paginator->currentPage() + 2
                        )

                            <span class="px-2 text-gray-400">...</span>

                        @endif

                    @endforeach
                @endif

            @endforeach

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