@extends('layouts.app_admin')
@section('title', 'ログインフォーム')
@section('content')

<div class="blue-board ">
    <div class="header_b">
        <div class="simple-wrap_sb">

        </div>
    </div>
    <div class="man-body_b">
        <form method="post" action="" class="blue">
            @csrf
            <h1>管理画面</h1>
            <div class="element_wrap">
                <label for="login_id">ログインID</label>
                <div class="content-wrap">
                    <input id="login_id" class=" @error('login_id') is-invalid @enderror" name="login_id"
                        value="{{ old('login_id') }}">
                </div>
            </div>
            <div class="element_wrap">
                <label for="password">パスワード</label>
                <div class="content-wrap">
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                        name="password">
                </div>
            </div>

            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <div class="btn-wrap">
                <input type="submit" class="btn_b" value="ログイン" />
            </div>
        </form>
    </div>
    <div class="header_b">
        <div class="simple-wrap_sb">

        </div>
    </div>
</div>


@endsection
