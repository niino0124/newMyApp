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

    <div class="man-body-tables" style="padding-top:5px;">


        <ul class="product_lists" style="border-top:none;">
            <li class="product" style="align-items:flex-start;">
                <div class="product_header"><img src="{{ '/storage/' . $input_data['image_1']}}" alt="" width="100" height="100"></div>
                <div class="product_body">
                    <div class="left-block">
                        <p class="product_name" style="color: black;">{{ $input_data['name'] }}</p>
                        <p class="product_star">総合評価　★★★　３</p>
                    </div>
                </div>
            </li>
        </ul>

        <form method="post" action="{{ route('product.review-store') }}">
            @csrf
            <div class="element_wrap_str_review">
                    <label for="evaluation" class="fw-bold label-w">商品評価</label>
                <p>{{ $input_data['evaluation'] }}</p>
            </div>

            <div class="element_wrap_str_review">
                <label for="comment" class="fw-bold label-w">商品コメント</label>
                <div class="content-wrap" style="text-align: left;">
                    {{ $input_data['comment'] }}
                </div>
            </div>
            <input hidden value="{{$input_data['image_1']}}" name="image_1">
            <input hidden value="{{ $input_data['name'] }}" name="name">
            <input hidden value="{{ $input_data['product_id'] }}" name="product_id">
            <input hidden value="{{$input_data['comment']}}" name="comment">
            <input hidden value="{{$input_data['evaluation']}}" name="evaluation">
            {{-- ブルー --}}
            <div class="btn-wrap" >
                <input href="" class="btn_b" value="レビューを削除" type="submit">
                <input href="{{url()->previous()}}" class="btn_b btn-back_b" name="back" value="前に戻る" type="submit">
            </div>
        </form>

    </div>
</div>


@endsection
