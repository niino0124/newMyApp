@extends('layouts.app')
@section('title', '会員登情報確認フォーム')
@section('content')

<form method="post" action="{{route('product.store')}}" class="block-b">
	@csrf
	<h1>会員登情報確認フォーム</h1>

	<div class="element_wrap_str">
		<label>商品名</label>
		<p>{{ $data["name"] }}</p>
	</div>

	<div class="element_wrap_str">
		<label>商品カテゴリ</label>
		<p>{{ $data["product_category_id"] }} ＞ {{ $data["product_subcategory_id"] }}</p>
	</div>

	@if (isset($data["read_temp_path"] ))
	<div class="element_wrap_str">
		<label>商品写真</label>
		<img src="{{ $data['read_temp_path']  }}" width="200" height="130">
	</div>
	@endif

	<div class="element_wrap_str">
		<label>商品説明</label>
		<p>{{ $data["product_content"] }}</p>
	</div>

	<div class="btn-wrap">
		<input type="submit" class="btn" value="登録完了" />
		<input name="back" type="submit" class="btn btn-back" value="前に戻る" />
	</div>

</form>
@endsection
