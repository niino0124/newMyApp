@extends('layouts.app')
@section('title', 'メールアドレス変更')
@section('content')
<div class="blue-board">
    <form method="POST" action="{{route('home.edit-email-send')}}">
        @csrf
        <h1>メールアドレス変更　認証コード入力</h1>

        <div class="element_wrap">
            （※ メールアドレスの変更はまだ完了していません）<br>変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を入力してください。
        </div>

        <div class="element_wrap">
            <label for="email">認証コード</label>
            <input id="email" type="email" name="email">
        </div>

                    <div class="btn-wrap">
                        <button type="submit" class="btn" name="submit">認証コードを送信してメールアドレスの変更を完了する
                        </button>
                    </div>

    </form>
</div>

@endsection
