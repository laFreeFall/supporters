@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="pagination-previous" disabled>@lang('pagination.previous')</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">@lang('pagination.next')</a>
        @else
            <button class="pagination-next" disabled>@lang('pagination.next')</button>
        @endif
    </nav>
@endif
