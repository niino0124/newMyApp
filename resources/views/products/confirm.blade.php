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
		<p>{{ $category }} ＞ {{ $sub_category }}</p>
	</div>


@if($data['path1'] !== NULL || $data['path2'] !== NULL)
<div class="element_wrap_str">

    <label>商品写真</label>

    <div class="">
        @if($data['path1'] !== NULL)
        <div class="view_box">
            <label class="image_label">写真１</label>
            <img src="{{ '/storage/' . $data['path1']}}" class=''  width="150" height="150"/>
        </div>
        @endif

        @if($data['path2'] !== NULL)
        <div class="view_box">
            <label class="image_label">写真２</label>
            <img src="{{ '/storage/' . $data['path2']}}" class=''  width="150" height="150"/>
        </div>
        @endif

        @if($data['path3'] !== NULL)
        <div class="view_box">
            <label class="image_label">写真３</label>
            <img src="{{ '/storage/' . $data['path3']}}" class=''  width="150" height="150"/>
        </div>
        @endif

        @if($data['path4'] !== NULL)
        <div class="view_box">
            <label class="image_label">写真４</label>
            <img src="{{ '/storage/' . $data['path4']}}" class=''  width="150" height="150"/>
        </div>
        @endif
    </div>

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
