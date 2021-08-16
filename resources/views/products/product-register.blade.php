@extends('layouts.app')
@section('title', '商品登録')
@section('content')
<form method="post" action="{{route('product.validation')}}" enctype="multipart/form-data" class="block-b">
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
        {{-- {{ ProductCategory::select( $categories) }} --}}
        <select name="product_category_id" class="mb-2 lg:mb-0 lg:mr-2">
        @foreach ($categories as $category)
        <option>{{$category->name}}</option>
        <br>
        @endforeach
        </select>
        <select name="product_subcategory_id" class="mb-2 lg:mb-0 lg:mr-2">
        @foreach ($subcategories as $subcategory)
        <option>{{$subcategory->name}}</option>
        <br>
        @endforeach
        </select>
        {{-- <select name="product_category_id" class="mb-2 lg:mb-0 lg:mr-2">
            <option value="0" @if(\Request::get('product_category_id') === '0') selected @endif>全て</option>
            @foreach($categories as $product_category_id)
            <optgroup label="{{ $product_category_id->name }}">
             @foreach($product_category_id->secondary as $secondary)
               <option value="{{ $secondary->id}}" @if(\Request::get('product_category_id') == $secondary->id) selected @endif >
                {{ $secondary->name }}
               </option>
             @endforeach
           @endforeach
        </select> --}}
        {{-- <input id="product_category_id" type="select" class=" @error('product_category_id') is-invalid @enderror" name="product_category_id" value="{{ old('product_category_id') }}" >

        @error('product_category_id')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror --}}
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
    <div class="relative">
    <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
    <input type="file" id="image" name="image" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
