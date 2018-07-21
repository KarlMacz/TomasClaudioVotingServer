@if($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if($paginator->onFirstPage())
            <div class="pagination-prev disabled"><span class="fas fa-chevron-left"></span></div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-prev"><span class="fas fa-chevron-left"></span></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if(is_string($element))
                <div class="pagination-page disabled">{{ $element }}</div>
            @endif

            {{-- Array Of Links --}}
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <div class="pagination-page active">{{ $page }}</div>
                    @else
                        <a href="{{ $url }}" class="pagination-page">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next"><span class="fas fa-chevron-right"></span></a>
        @else
            <div class="pagination-next disabled"><span class="fas fa-chevron-right"></span></div>
        @endif
    </div>
@endif
