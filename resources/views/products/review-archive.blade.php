@extends('layouts.app')
@section('title', '商品レビュー一覧')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー一覧</p>
            <div class="simple-wrap">
                @auth
                <a href="/home" class="btn-simple">トップに戻る</a>
                @endauth
                @guest
                <a href="/" class="btn-simple">トップに戻る</a>
                @endguest
            </div>
        </div>
    </div>
    <div class="man-body-tables">
        <ul class="product_top">
            <li class="product">
                <div class="product_header"><img src="{{ '/storage/' . $product['image_1']}}" alt="" width="100"
                        height="100"></div>
                <div class="product_body">
                    <div class="left-block" >
                        <p class="product_name" style="color: black;">{{ $product['name'] }}</p>
                        {{-- <p class="product_star" >総合評価　@for($i = 0; $i < $avg; $i++)★@endfor {{$avg}}</p> --}}
                        <p class="product_star" >総合評価　@for($i = 0; $i < $product->getAvgStarAttribute(); $i++)★@endfor {{$product->getAvgStarAttribute()}}</p>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="product_lists">
            @foreach ($reviews as $review)
            <li class="product">
                <div class="product_header comment_header">
                    <p class="who">{{$review->member->nickname}}さん</p>
                    <p class="comment_content">商品コメント</p>
                </div>

                <div class="product_body">
                    <div class="left-block">
                        <p>@for($i = 0; $i < $review->evaluation; $i++)★@endfor　{{$review->evaluation}}</p>
                        <p style="margin-top: 10px;line-height:1.6;">{{$review->comment}}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        {{ $reviews->appends(request()->input())->links() }}
        <div class="btn-wrap">
            <a href="{{route('product.show',['id' => $product['id']])}}" class="btn_b">商品詳細に戻る</a>
        </div>
    </div>
</div>
@endsection
