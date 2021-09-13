@extends('layouts.app')
@section('title', 'メールアドレス変更')
@section('content')
<div class="blue-board">

    <form method="POST" action="{{route('home.edit-email-complete')}}">
        @csrf
        <h1>メールアドレス変更　認証コード入力</h1>

        <div class="element_wrap">
            <p class="tal">
                （※ メールアドレスの変更はまだ完了していません）<br>変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を入<br>力してください。
            </p>
        </div>

        <div class="element_wrap_str">
            <label for="auth_code">　　認証コード</label>
            <div class="content-wrap">
                <input id="auth_code_input"  name="auth_code_input">
                @error('auth_code_input')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="btn-wrap">
            <button type="submit" class="btn" name="submit">認証コードを送信してメールアドレスの変更を完了する
            </button>
        </div>

        <input hidden value="{{$email}}" name="email">
        <input hidden value="{{$auth_code}}" name="auth_code">

    </form>
</div>

@endsection
