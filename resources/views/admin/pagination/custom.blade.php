@if ($paginator->hasPages() || $paginator->total() > 0)
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Text hiển thị số dòng (Left side) -->
        <div class="text-sm text-slate-500">
            Hiển thị {{ $paginator->firstItem() ?? 0 }} đến {{ $paginator->lastItem() ?? 0 }} của {{ $paginator->total() }} kết quả
        </div>
        
        <!-- Right side: Dropdown + Pagination -->
        <div class="flex items-center gap-4">
            <!-- Dropdown chọn số lượng / trang -->
            <!-- Dropdown chọn số lượng / trang -->
            <div class="flex items-center gap-2" x-data="{
                perPage: '{{ request('per_page', 10) }}',
                updatePerPage() {
                    const url = new URL(window.location.href);
                    url.searchParams.set('per_page', this.perPage);
                    url.searchParams.set('page', '1');
                    if (typeof window.fetchAndReplace === 'function') {
                        window.fetchAndReplace(url.toString());
                    } else {
                        window.location.href = url.toString();
                    }
                }
            }">
                <span class="text-sm text-slate-500">Hiển thị</span>
                <select x-model="perPage" @change="updatePerPage()" class="h-9 px-3 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 focus:outline-none focus:border-[#41859c] focus:ring-1 focus:ring-[#41859c] shadow-sm cursor-pointer outline-none">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            @if ($paginator->hasPages())
            <nav class="flex items-center gap-1.5" aria-label="Pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-slate-50 text-slate-300 cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 hover:text-[#41859c] transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="inline-flex items-center justify-center px-2 text-sm font-bold text-slate-400">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2.5 rounded-lg bg-[#41859c] border border-[#41859c] text-white text-sm font-bold shadow-sm">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2.5 rounded-lg border border-slate-200 bg-white text-[#41859c] text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 hover:text-[#41859c] transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @else
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-slate-50 text-slate-300 cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                @endif
            </nav>
            @endif
        </div>
    </div>
@endif
