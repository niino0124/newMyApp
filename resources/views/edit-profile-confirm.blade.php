@extends('layouts.app')
@section('title', '会員情報変更ページ')
@section('content')

<form method="post" action="{{route('home.edit-profile-store')}}" class="block-b">
	@csrf
  <h1>会員情報変更ページ</h1>

  <div class="element_wrap_str">
    <label>氏名</label>
    <p>{{ $input["name_sei"] }}　{{ $input["name_mei"] }}</p>
  </div>
  <div class="element_wrap_str">
    <label>ニックネーム</label>
    <p>{{ $input["nickname"] }}</p>
  </div>
  <div class="element_wrap_str">
    <label>性別</label>
    <p>@if( $input["gender"]  == "1")男性 @else 女性@endif</p>
  </div>

<input name="name_sei" value="{{ $input["name_sei"] }}" hidden>
<input name="name_mei" value="{{ $input["name_mei"] }}" hidden>
<input name="nickname" value="{{ $input["nickname"] }}" hidden>
<input name="gender" value="{{ $input["gender"] }}" hidden>

<div class="btn-wrap">
    <input type="submit" class="btn" value="変更完了" />
    <input name="back" type="submit" class="btn btn-back" value="前に戻る" />
</div>
</form>
@endsection
