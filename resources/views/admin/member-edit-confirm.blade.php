@extends('layouts.app_admin')
@section('title', '会員編集')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">会員編集</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{route('admin.home')}}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        @if ($input["id"] != null)
        <form method="post" action="{{route('admin.member-edit-complete')}}">
            @csrf
            <div class="element_wrap_str">
                <label>ID</label>
                <p>{{ $input["id"] }}</p>
            </div>
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
                <p>@if( $input["gender"] == "1")男性 @else 女性@endif</p>
            </div>
            <div class="element_wrap_str">
                <label>パスワード</label>
                <p>セキュリティのため非表示</p>
            </div>
            <div class="element_wrap_str">
                <label>メールアドレス</label>
                <p>{{ $input["email"] }}</p>
            </div>

            <input value="{{ $input["id"] }}" name="id" hidden>
            <input value="{{ $input["name_sei"] }}" name="name_sei" hidden>
            <input value="{{ $input["name_mei"] }}" name="name_mei" hidden>
            <input value="{{ $input["nickname"] }}" name="nickname" hidden>
            <input value="{{ $input["gender"] }}" name="gender" hidden>
            <input value="{{ $input["email"] }}" name="email" hidden>
            <input value="{{ $input["password"] }}" name="password" hidden>

            <div class="btn-wrap">
                <input type="submit" class="btn-back_b" value="編集完了" />
                <input href="{{url()->previous()}}" class="btn_b" name="back" value="前に戻る" type="submit">

            </div>
        </form>
        @else
        <form method="post" action="{{route('admin.member-register-complete')}}">
            @csrf
            <div class="element_wrap_str">
                <label>ID</label>
                <p>登録後に自動採番</p>
            </div>
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
                <p>@if( $input["gender"] == "1")男性 @else 女性@endif</p>
            </div>
            <div class="element_wrap_str">
                <label>パスワード</label>
                <p>セキュリティのため非表示</p>
            </div>
            <div class="element_wrap_str">
                <label>メールアドレス</label>
                <p>{{ $input["email"] }}</p>
            </div>

            <input value="{{ $input["name_sei"] }}" name="name_sei" hidden>
            <input value="{{ $input["name_mei"] }}" name="name_mei" hidden>
            <input value="{{ $input["nickname"] }}" name="nickname" hidden>
            <input value="{{ $input["gender"] }}" name="gender" hidden>
            <input value="{{ $input["email"] }}" name="email" hidden>
            <input value="{{ $input["password"] }}" name="password" hidden>

            <div class="btn-wrap">
                <input type="submit" class="btn-back_b" value="登録完了" />
                <input href="{{url()->previous()}}" class="btn_b" name="back" value="前に戻る" type="submit">

            </div>
        </form>
        @endif

    </div>
</div>
@endsection
