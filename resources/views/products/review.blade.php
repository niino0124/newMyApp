@extends('layouts.app')
@section('title', '商品レビュー登録')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー登録</p>
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

        <form method="post" action="{{ route('product.review-confirm',['id' => $product->id]) }}">
            @csrf
            <div class="element_wrap_str_review">
                    <label for="evaluation" class="evaluation">商品評価</label>

                    <div class="cp_ipselect cp_sl02">
                        <select required name="evaluation">
                            <option value="" hidden>選択してください</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                        </div>

                            @error('evaluation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
            </div>
            <div class="element_wrap_fill_no_margin">
                <label for="comment">商品コメント</label>
                <div class="content-wrap">
                    <textarea id="comment" type="text" class=" @error('comment') is-invalid @enderror"
                        name="comment" style="height: 90px">{{ old('comment') }}</textarea>
                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- ブルー --}}
            <div class="btn-wrap" >
                <input  class="btn_b" type="submit" value="商品レビュー登録確認">
                <a href="{{url()->previous()}}" class="btn_b btn-back_b">商品詳細に戻る</a>
            </div>
        </form>





    </div>
</div>


@endsection
