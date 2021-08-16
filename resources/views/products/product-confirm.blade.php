@extends('layouts.app')
@section('title', '会員登情報確認フォーム')
@section('content')
<form method="post" action="{{route('product.send')}}" class="block-b">
	@csrf
  <h1>会員登情報確認フォーム</h1>


  <div class="element_wrap_str">
    <label>商品名</label>
    <p>{{ $input["name"] }}</p>
  </div>
  <div class="element_wrap_str">
    <label>商品カテゴリ</label>
    <p>{{ $input["product_category_id"] }} > {{ $input["product_subcategory_id"] }}</p>
  </div>
  <div class="element_wrap_str">
    <label>商品写真</label>
    <p>{{ $input["image"] }}</p>
 </div>

   <div class="element_wrap_str">
    <label>商品説明</label>
    <p>{{ $input["product_content"] }}</p>
  </div>

<div class="btn-wrap">
    <input type="submit" class="btn" value="登録完了" />
    <input name="back" type="submit" class="btn btn-back" value="前に戻る" />
</div>
</form>
@endsection
