@extends('layouts.app')
@section('title', 'マイページ')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p>マイページ</p>
            <div class="simple-wrap">

                <a class="btn-simple" href="{{route('home')}}">
                    トップに戻る
                </a>
                <a class="btn-simple" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="man-body">
        <div class="element_wrap_str">
            <label>氏名</label>
            <p>{{ Auth::user()->name_sei }}　{{ Auth::user()->name_mei }}</p>
        </div>
        <div class="element_wrap_str">
            <label>ニックネーム</label>
            <p>{{ Auth::user()->nickname }}</p>
        </div>
        <div class="element_wrap_str">
            <label>性別</label>
            <p>@if( Auth::user()->gender == "1")男性 @else 女性@endif</p>
        </div>
        <div class="element_wrap_str">
            <label>パスワード</label>
            <p>セキュリティのため非表示</p>
        </div>
        <div class="element_wrap_str">
            <label>メールアドレス</label>
            <p>{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>
@endsection