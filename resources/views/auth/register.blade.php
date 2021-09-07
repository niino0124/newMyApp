@extends('layouts.app')
@section('title', '会員登録フォーム')
@section('content')

<form method="post" action="{{ route('register') }}" class="block-b">
    @csrf
<h1>会員登録画面</h1>

<div class="element_wrap">
    <label>氏名</label>
    <label class="name-label" for="name_sei">姓</label>
    <div class="content_wrap">

        <input id="name_sei" type="text" class=" @error('name_sei') is-invalid @enderror" name="name_sei" value="{{ old('name_sei') }}" >

        @error('name_sei')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>

    <label class="name-label" for="name_mei">名</label>
    <div class="content-wrap">

        <input id="name_mei" type="text" class=" @error('name_mei') is-invalid @enderror" name="name_mei" value="{{ old('name_mei') }}">
        @error('name_mei')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="element_wrap">
    <label for="nickname">ニックネーム</label>
    <div class="content-wrap">
            <input id="nickname" type="text" class=" @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" >
            @error('nickname')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>

<div class="element_wrap">
    <label for="gender">性別</label>
    <div class="content-wrap">
            <div>
                    @foreach(config('master.gender') as $index => $value)
                    <label for="gender">
                            <input value='{{ $index }}'
                            type="radio"  class="@error('gender')is-invalid @enderror" name="gender" @if(old('gender') == $index) checked @endif id="gender">
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if($index == "1") 男性 @else 女性 @endif
                    </label>
                    @endforeach
                </div>
    </div>
</div>
<div class="element_wrap">
    <label for="password">パスワード</label>
    <div class="content-wrap">
            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>
<div class="element_wrap">
    <label for="password_confirmation">パスワード確認</label>
    <div class="content-wrap">
            <input id="password-confirm" type="password" class="" name="password_confirmation">
    </div>
</div>
<div class="element_wrap">
    <label for="email">メールアドレス</label>
    <div class="content-wrap">
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

            @error('email')
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
