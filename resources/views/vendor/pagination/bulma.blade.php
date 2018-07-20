@if ($paginator->hasPages())
    <nav class="pagination is-centered is-rounded" role="navigation" aria-label="navigation">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="pagination-link" disabled>&laquo;</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    {{--<li class="disabled"><span>{{ $element }}</span></li>--}}
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a href="{{ $url }}" class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}" class="pagination-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link">&raquo;</a>
            @else
                <button class="pagination-link" disabled>&raquo;</button>
            @endif
        </ul>
    </nav>
@endif
