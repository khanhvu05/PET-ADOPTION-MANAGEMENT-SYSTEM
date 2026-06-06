@if ($paginator->hasPages() || $paginator->total() > 0)
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 w-full">
        <!-- Text hiển thị số dòng (Left side) -->
        <div class="text-[13px] font-medium text-gray-500">
            Hiển thị {{ $paginator->firstItem() ?? 0 }} đến {{ $paginator->lastItem() ?? 0 }} của {{ $paginator->total() }} kết quả
        </div>
        
        <!-- Right side: Pagination Links -->
        @if ($paginator->hasPages())
        <nav class="flex items-center gap-2" aria-label="Pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-gray-50 border border-gray-100 text-gray-300 flex items-center justify-center cursor-not-allowed shadow-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-gray-400 flex items-center justify-center hover:bg-gray-50 hover:text-gray-600 transition shadow-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="text-gray-400 px-1 font-bold text-xs md:text-sm">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-lg bg-[#F58A3C] text-white font-black shadow-[0_4px_10px_rgba(245,138,60,0.3)] text-xs md:text-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-lg bg-white border border-gray-100 text-[#1D2B53] font-black hover:bg-gray-50 transition shadow-sm text-xs md:text-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-gray-400 flex items-center justify-center hover:bg-gray-50 hover:text-gray-600 transition shadow-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </a>
            @else
                <span class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-gray-50 border border-gray-100 text-gray-300 flex items-center justify-center cursor-not-allowed shadow-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </span>
            @endif
        </nav>
        @endif
    </div>
@endif
