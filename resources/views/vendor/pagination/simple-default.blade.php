@if($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if($paginator->onFirstPage())
            <div class="pagination-prev disabled"><span class="fas fa-chevron-left"></span></div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-prev"><span class="fas fa-chevron-left"></span></a>
        @endif

        {{-- Next Page Link --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next"><span class="fas fa-chevron-right"></span></a>
        @else
            <div class="pagination-next disabled"><span class="fas fa-chevron-right"></span></div>
        @endif
    </div>
@endif
