@extends('layouts.app')
@section('title', 'ログインフォーム')
@section('content')

<form method="post" action="{{ route('login') }}" class="block-b form_blue">
    @csrf
    <h1>管理画面</h1>
    <div class="element_wrap">
        <label for="email">ログインID</label>
        <div class="content-wrap">
            <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">
        </div>
    </div>
    <div class="element_wrap">
        <label for="password">パスワード</label>
        <div class="content-wrap">
            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password">

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
        <input type="submit" class="btn" value="ログイン" />
    </div>
</form>
@endsection
