@extends('layouts.app_admin')
@section('title', '商品詳細')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品詳細</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ $back_url }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        <form>
            @foreach ($product_info as $product)
            <div class="element_wrap_str">
                <label>商品ID</label>
                <p>{{$product->id}}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品名</label>
                <p>{{$product->name_sei}}　{{$product->name_mei}}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品カテゴリ</label>
                <p>{{$product->nickname}}</p>
            </div>

            <div class="element_wrap_str">
                <label>商品写真</label>
                <div class="">
                    @if($product->path1 !== NULL)
                    <div class="view_box">
                        <label class="image_label">写真１</label>
                        <img src="{{ '/storage/' . $product->path1}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if($product->path2 !== NULL)
                    <div class="view_box">
                        <label class="image_label">写真２</label>
                        <img src="{{ '/storage/' . $product->path2}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if($product->path3 !== NULL)
                    <div class="view_box">
                        <label class="image_label">写真３</label>
                        <img src="{{ '/storage/' . $product->path3}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if($product->path4 !== NULL)
                    <div class="view_box">
                        <label class="image_label">写真４</label>
                        <img src="{{ '/storage/' . $product->path4}}" class=''  width="150" height="150"/>
                    </div>
                    @endif
                </div>
            </div>
            <div class="">
                <a href="{{route('admin.product-edit',['id' => $product->id])}}" class="btn-back_b">編集</a>
                <a href="{{route('admin.product-delete',['id' => $product->id])}}" class="btn-back_b" >削除</a>
            </div>
            @endforeach

        </form>
    </div>
</div>
@endsection
