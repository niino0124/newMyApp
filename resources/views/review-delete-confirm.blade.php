@extends('layouts.app')
@section('title', '商品レビュー削除確認')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー削除確認</p>
            <div class="simple-wrap">
                <a href="{{route('home')}}" class="btn-simple" >トップに戻る</a>
            </div>
        </div>
    </div>

    @foreach ($infos as $info)
    <div class="man-body-tables" style="padding-top:5px;">
        <ul class="product_lists" style="border-top:none;">
            <li class="product" style="align-items:flex-start;">
                <div class="product_header"><img src="{{ '/storage/' .$info->product->image_1}}" alt="" width="100"
                        height="100"></div>
                <div class="product_body">
                    <div class="left-block">
                        <p class="product_name" style="color: black;">{{ $info->product->name }}</p>
                        <p class="product_star">@if($info->product->getAvgStarAttribute() == 0)評価なし@else 総合評価　 @for($i =
                            0; $i < $info->product->getAvgStarAttribute();
                                $i++)★@endfor　{{ $info->product->getAvgStarAttribute() }}@endif</p>
                    </div>
                </div>
            </li>
        </ul>

        <form method="post" action="{{ route('home.review-delete-complete') }}">
            @csrf
            <div class="element_wrap_str_review">
                    <label for="evaluation" class="fw-bold label-w">商品評価</label>
                <p>{{ $info->evaluation }}</p>
            </div>

            <div class="element_wrap_str_review">
                <label for="comment" class="fw-bold label-w">商品コメント</label>
                <div class="content-wrap" style="text-align: left;">
                    {{ $info->comment }}
                </div>
            </div>

            <input hidden value="{{ $info->id }}" name="id">
            {{-- ブルー --}}
            <div class="btn-wrap" >
                <input href="" class="btn_b" value="レビューを削除" type="submit">
                <a href="{{$back_url}}" class="btn_b btn-back_b" name="back" >前に戻る</a>
            </div>
        </form>

    </div>
    @endforeach
</div>
@endsection
