@extends('layouts.app')
@section('title', '商品登録')
@section('content')
<form method="post" action="{{route('product.resister_show')}}" class="block-b">
    @csrf
<h1>商品登録</h1>
<div class="element_wrap">
    <label for="name">商品名</label>
    <div class="content-wrap">
            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>

<div class="element_wrap">
    <label>商品カテゴリ</label>
    <div class="content_wrap">
        <input id="product_category_id" type="select" class=" @error('product_category_id') is-invalid @enderror" name="product_category_id" value="{{ old('product_category_id') }}" >

        @error('product_category_id')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="content-wrap">
        <input id="product_subcategory_id" type="select" class=" @error('product_subcategory_id') is-invalid @enderror" name="product_subcategory_id" value="{{ old('product_subcategory_id') }}" >
        @error('product_subcategory_id')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="element_wrap">
    <label for="product_content">商品説明</label>
    <div class="content-wrap">
            <textarea id="product_content" type="product_content" class=" @error('product_content') is-invalid @enderror" name="product_content">{{ old('product_content') }}</textarea>
            @error('product_content')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>


<div class="btn-wrap">
    <input class="btn" type="submit" value="確認画面へ" />
    <a href="/" class="btn btn-back">トップに戻る</a>
</div>
</form>

@endsection
