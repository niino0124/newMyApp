@extends('layouts.app')
@section('title', 'トップページ（ログイン状態時）')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品一覧</p>
            <div class="simple-wrap">

                <a class="btn-simple" href="{{route('product.index')}}">
                    新規商品登録
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="man-body-tables">
        <form class="search-wrap" method="GET" action="{{route('product.list')}}">
            @csrf
            <label for="">カテゴリ
                <select name="category" id="category">
                    <option value="">選択してください</option>
                    @foreach ($product_categories as $product_category)
                    <option value="{{$product_category->id}}" @if(old('product_category_id')==$product_category->id)
                        selected @endif >{{$product_category->name}}</option>
                    @endforeach
                </select>
                <select name="sub_category" id="sub_category">
                    <option value=""></option>
                </select>
            </label>
            <label for="">フリーワード
                <input type="search" class="long" name="search">
            </label>
            <button type="submit" class="btn-simple">商品検索</button>
        </form>


        <ul class="product_lists">
            <li class="product">
                <div class="product_header"><img src="" alt=""></div>
                <div class="product_body">
                    <p class="cat">大カテゴリー＞小カテゴリー</p>
                    <p class="product_name">商品名</p>
                </div>
            </li>
        </ul>


        <ul class="example">
            <li class=" t_next"><a class="" href="#">＜前へ</a></li>
            <li class=""><a class=" this" href="#">1</a></li>
            <li class=""><a class="" href="#">2</a></li>
            <li class=""><a class="" href="#">3</a></li>
            <li class="t_next"><a class="" href="#">次へ＞</a></li>
        </ul>

        <div class="btn-wrap">
            <a href="/" class="btn btn-back-bl" s>トップに戻る</a>
        </div>

    </div>
</div>
@endsection
