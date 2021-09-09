@extends('layouts.app')
@section('title', '商品詳細')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品詳細</p>
            <div class="simple-wrap">
                @auth
                <a href="/home" class="btn-simple" >トップに戻る</a>
                @endauth
                @guest
                <a href="/" class="btn-simple" >トップに戻る</a>
                @endguest
            </div>
        </div>
    </div>

    <div class="man-body-tables">
<div class="show_wrap">
    <p>{{ $product->productCategory->name }} ＞ {{ $product->productSubcategory->name }}</p>
    <div class="name_wrap">
        <p class="name">{{$product->name}}</p>
        <p>更新日時：{{$product->created_at}}</p>
    </div>
    <div class="img_wrap">
        @if($product->image_1)
        <div class="img_wrap_item"><img src="{{ '/storage/' .$product->image_1}}" alt="" width="100" height="100"></div>
        @endif
        @if($product->image_2)
        <div class="img_wrap_item"><img src="{{ '/storage/' .$product->image_2}}" alt="" width="100" height="100"></div>
        @endif
        @if($product->image_3)
        <div class="img_wrap_item"><img src="{{ '/storage/' .$product->image_3}}" alt="" width="100" height="100"></div>
        @endif
        @if($product->image_4)
        <div class="img_wrap_item"><img src="{{ '/storage/' .$product->image_4}}" alt="" width="100" height="100"></div>
        @endif
    </div>
    <div class="content_wrap">
        <p>■商品説明</p>
        <p>{{$product->product_content}}</p>
    </div>
    <div class="content_wrap">
        <p>■商品レビュー</p>
        <p>総合評価　@for($i = 0; $i < $avg; $i++)★@endfor {{ $avg }}</p>
        <p><a href="{{route('product.review-archive',['id' => $product->id])}}"> ＞＞レビューを見る</a></p>
    </div>
</div>






        <div class="btn-wrap" >
            <a href="{{ route('product.review',['id' => $product->id]) }}" class="blue_btn_md_con">この商品についてのレビューを登録</a>
            <a href="{{route('product.list')}}" class="blue_btn_md">商品一覧に戻る</a>
        </div>
    </div>
</div>


@endsection
