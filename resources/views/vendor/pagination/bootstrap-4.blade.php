@if ($paginator->hasPages())
    <nav>
        <ul class="example">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="t_prev " aria-disabled="true" aria-label="@lang('pagination.previous')">
                    < 前へ
                </li>
            @else
                <li class="t_prev">
                    <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">< 前へ</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="mid this" aria-disabled="true">{{ $element }}</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="mid active" aria-current="page">{{ $page }}</li>
                        @else
                            <li class="mid"><a class="" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="t_next">
                    <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">次へ ></a>
                </li>
            @else
                <li class="t_next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    次へ >
                </li>
            @endif
        </ul>
    </nav>
@endif
