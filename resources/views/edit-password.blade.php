@extends('layouts.app')
@section('title', 'パスワード変更')
@section('content')
<div class="blue-board">
    <form method="POST" action="{{route('home.edit-password-store')}}">
        @csrf
        <h1>パスワード変更</h1>

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
            <label for="password_confirm">パスワード確認</label>
            <input id="password_confirm" type="password" name="password_confirmation" autocomplete="new-password">
        </div>

                    <div class="btn-wrap">
                        <button type="submit" class="btn" name="submit">パスワードを変更</button>
                        <a type="button" class="btn btn-back" href="{{route('home.show')}}">マイページに戻る</a>
                    </div>

    </form>
</div>

@endsection
