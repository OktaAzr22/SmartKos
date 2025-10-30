@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-6 py-4 border-t border-gray-200">
        <div class="text-sm text-gray-500">
            Showing 
            <span class="font-medium">{{ $paginator->firstItem() ?? 0 }}</span>
            to 
            <span class="font-medium">{{ $paginator->lastItem() ?? 0 }}</span>
            of 
            <span class="font-medium">{{ $paginator->total() }}</span>
            results
        </div>

        <div class="flex space-x-2">
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Previous
                </a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-1 text-sm text-gray-500">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 text-sm font-medium text-white bg-primary-500 border border-primary-500 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Next
                </a>
            @else
                <span class="px-3 py-1 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </nav>
@endif
