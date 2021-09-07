@extends('layouts.app')
@section('title', '商品レビュー登録確認')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー登録確認</p>
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

    <div class="man-body-tables" style="padding-top:5px;">


        <ul class="product_lists" style="border-top:none;">
            <li class="product" style="align-items:flex-start;">
                <div class="product_header"><img src="{{ '/storage/' .$product->image_1}}" alt="" width="100" height="100"></div>
                <div class="product_body">
                    <div class="left-block">
                        <p class="product_name" style="color: black;">{{$product->name}}</p>
                        <p class="product_star">総合評価　★★★　３</p>
                    </div>
                </div>
            </li>
        </ul>

        <form method="post" action="{{ route('product.review-store',['id' => $product->id]) }}">
            @csrf
            <div class="element_wrap_str_review">
                    <label for="evaluation" class="evaluation">商品評価</label>
                <p>{{ $request->evaluation }}</p>
            </div>

            <div class="element_wrap_fill_no_margin">
                <label for="comment">商品コメント</label>
                <div class="content-wrap">
                    {{ $request->comment }}
                </div>
            </div>
            {{-- ブルー --}}
            <div class="btn-wrap" >
                <input href="" class="btn_b" value="登録する" type="submit">
                <input href="{{url()->previous()}}" class="btn_b btn-back_b" name="back" value="前に戻る" type="submit">
            </div>
        </form>

    </div>
</div>


@endsection
