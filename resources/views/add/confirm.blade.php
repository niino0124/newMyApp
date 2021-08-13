@extends('layouts.app')
@section('title', '会員登情報確認フォーム')
@section('content')
<form method="post" action="" class="block-b">
	@csrf
  <h1>会員登情報確認フォーム</h1>


  <div class="element_wrap_str">
    <label>氏名</label>
    <p>{{ $input["name_sei"] }}</p>
  </div>
  <div class="element_wrap_str">
    <label>ニックネーム</label>
    <p>{{ $input["name_mei"] }}</p>
  </div>
  <div class="element_wrap_str">
    <label>性別</label>
    <p>@if( $input["gender"]  == "1")男性 @else 女性@endif</p>
  </div>
  <div class="element_wrap_str">
    <label>パスワード</label>
    <p>セキュリティのため非表示</p>
  </div>  <div class="element_wrap_str">
    <label>メールアドレス</label>
    <p>{{ $input["email"] }}</p>
  </div>

<div class="btn-wrap">
    <input type="submit" class="btn" value="登録完了" />
    <input name="back" type="submit" class="btn btn-back" value="前に戻る" />
</div>
</form>
@endsection
