@if ($paginator->hasPages())
<nav>
    <ul class="example">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())　　　
        @else <li class="t_prev">
                <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')">
                    < 前へ</a> </li> @endif


{{-- 中間の数字 --}}
                    {{-- 定数よりもページ数が多い時 --}}
                        @if ($paginator->lastPage() > 3)

                        {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
                        @if ($paginator->currentPage() <= floor(3 / 2))

                            <?php $start_page = 1; //最初のページ ?> <?php $end_page = 3; ?>
                            {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
                            @elseif ($paginator->currentPage() > $paginator->lastPage() - floor(3 / 2))

                            <?php $start_page = $paginator->lastPage() - (3 - 1); ?>
                            <?php $end_page = $paginator->lastPage(); ?>

                            {{-- 現在ページが表示するリンクの中心位置の時 --}}
                            @else
                            <?php $start_page = $paginator->currentPage() - (floor((3 % 2 == 0 ? 3 - 1 : 3)  / 2));?>
                            <?php $end_page = $paginator->currentPage() + floor(3 / 2); ?>
                            @endif

                            {{-- 定数よりもページ数が少ない時 --}}
                            @else
                            <?php $start_page = 1; ?>
                            <?php $end_page = $paginator->lastPage(); ?>
                            @endif

                            {{-- 処理部分 --}}
                            @for ($i = $start_page; $i <= $end_page; $i++) @if ($i==$paginator->currentPage())
        <li class="mid"><a class="this">{{ $i }}</a></li>
        @else
        <li class="mid"><a class="" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
        @endfor





        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="t_next">
            <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">次へ ></a>
        </li>
        @else
        　　　
        @endif
    </ul>
</nav>
@endif
