@extends('layouts.app')
@section('title', 'トップページ（ログイン状態時）')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="welcome_name">ようこそ{{ Auth::user()->nickname }}様</p>
<div class="simple-wrap">
    <a class="btn-simple" href="{{route('product.list')}}">
    商品一覧
    </a>
    <a class="btn-simple" href="{{route('product.index')}}">
    新規商品登録
    </a>
    <a class="btn-simple" href="{{route('home.show')}}">
    マイページ
    </a>
    <a class="btn-simple" href="{{ route('logout') }}"
    onclick="event.preventDefault();
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

    </div>
</div>


@endsection
