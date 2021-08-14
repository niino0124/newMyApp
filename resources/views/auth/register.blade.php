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
            <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
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
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
