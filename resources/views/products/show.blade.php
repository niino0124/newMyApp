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
    <p>{{$product->product_category_id}} ＞ {{$product->product_subcategory_id}}</p>
    <div class="name_wrap">
        <p class="name">{{$product->name}}</p>
        <p>更新日時：{{$product->created_at}}</p>
    </div>
    <div class="img_wrap">
        <div class="img_wrap_item"><img src="{{ '/storage/' .$product->image_1}}" alt="" width="100" height="100"></div>
        <div class="img_wrap_item"><img src="{{ '/storage/' .$product->image_2}}" alt="" width="100" height="100"></div>
    </div>
    <div class="content_wrap">
        <p>■商品説明</p>
        <p>{{$product->product_content}}</p>
    </div>
</div>






        <div class="btn-wrap" >
            <a href="{{url()->previous()}}" class="blue_btn_md">商品一覧に戻る</a>
        </div>

    </div>
</div>


@endsection
