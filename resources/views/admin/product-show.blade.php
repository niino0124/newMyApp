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
            <div class="element_wrap_str">
                <label>商品ID</label>
                <p>{{$product->id}}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品名</label>
                <p>{{$product->name}}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品カテゴリ</label>
                <p>{{$product->productCategory->name}} > {{$product->productSubcategory->name}}</p>
            </div>

            @if (isset($product->image_1) || isset($product->image_2)|| isset($product->image_3) || isset($product->image_4))
            <div class="element_wrap_str">
                <label>商品写真</label>
                <div class="">
                    @if(isset($product->image_1))
                    <div class="view_box">
                        <label class="image_label">写真１</label>
                        <img src="{{ '/storage/' . $product->image_1}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if(isset($product->image_2))
                    <div class="view_box">
                        <label class="image_label">写真２</label>
                        <img src="{{ '/storage/' . $product->image_2}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if(isset($product->image_3))
                    <div class="view_box">
                        <label class="image_label">写真３</label>
                        <img src="{{ '/storage/' . $product->image_3}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if(isset($product->image_4))
                    <div class="view_box">
                        <label class="image_label">写真４</label>
                        <img src="{{ '/storage/' . $product->image_4}}" class=''  width="150" height="150"/>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            <div class="">
                <a href="{{route('admin.product-edit',['id' => $product->id])}}" class="btn-back_b">編集</a>
                <a href="{{route('admin.product-delete',['id' => $product->id])}}" class="btn-back_b" >削除</a>
            </div>

        </form>
    </div>
</div>
@endsection
