@extends('layouts.app_admin')
@section('title', '管理画面メインメニュー')

@section('content')

<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">管理画面メインメニュー</p>
            <div class="simple-wrap">
                <p class="welcome_name">ようこそ{{ Auth::user()->name }}さん</p>
                <a class="btn-simple" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        <div class=" btn-wrap">
            <a href="{{route('admin.members')}}" class="btn_b btn-back_b" style="margin:0;margin-right: auto">会員一覧</a>
            <a href="{{route('admin.categories')}}" class="btn_b btn-back_b" style="margin:0;margin-right: auto;margin-top:15px;">商品カテゴリ一覧</a>
        </div>
    </div>
</div>

@endsection
