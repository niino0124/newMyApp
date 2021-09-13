@extends('layouts.app')
@section('title', 'パスワード変更')
@section('content')
<div class="blue-board">
    <form method="POST" action="{{route('home.edit-email-send')}}">
        @csrf
        <h1>メールアドレス変更</h1>

        <div class="element_wrap">
            <label>現在のメールアドレス <p style="color: dodgerblue;">　　{{ Auth::user()->email }}</p></label>
        </div>

        <div class="element_wrap">
            <label for="email">変更後のメールアドレス</label>

            <div class="content-wrap">
                <input id="email" type="email" name="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

        </div>

                    <div class="btn-wrap">
                        <button type="submit" class="btn" name="submit">認証メール送信</button>
                        <a type="button" class="btn btn-back" href="{{route('home.show')}}">マイページに戻る</a>
                    </div>

    </form>
</div>

@endsection
