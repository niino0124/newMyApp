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
            <div class="fl_col_start">
                <p class="tal">@if( Auth::user()->gender == "1")男性 @else 女性@endif</p>
                {{-- ブルー --}}
                <a href="{{route('home.edit-profile')}}" class="btn_b" type="submit" >会員情報変更</a>
            </div>
        </div>

        <div class="element_wrap_str">
            <label>パスワード</label>
            <div class="fl_col_start">
                <p class="tal">セキュリティのため非表示</p>
            <a href="" class="btn_b" type="submit" style="margin-right: 0;margin-left:0;">パスワード変更</a>
            </div>
        </div>
        <div class="element_wrap_str">
            <label>メールアドレス</label>
            <div class="fl_col_start">
            <p class="tal">{{Auth::user()->email}}</p>
                {{-- ブルー --}}
                <a href="" class="btn_b" type="submit" >メールアドレス変更</a>
            </div>
        </div>

        {{-- ブルー --}}
        <div class="btn-wrap">
            <a href="{{route('home.leave')}}" class="btn-back_b" type="submit">退会</a>
        </div>

    </div>
</div>
@endsection