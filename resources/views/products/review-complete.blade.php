@extends('layouts.app')
@section('title', '商品レビュー登録完了')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー登録完了</p>
            <div class="simple-wrap">
                <a href="/home" class="btn-simple" >トップに戻る</a>
            </div>
        </div>
    </div>

    <div class="man-body" >

        <div class="btn-wrap" >
            <a href="{{route('product.review-archive',['id' => $id])}}" class="btn_b btn-back_b">商品レビュー一覧へ</a>
            <a href="{{route('product.show',['id' => $id])}}" class="btn_b"  >商品詳細に戻る</a>
        </div>

    </div>
</div>

@endsection
