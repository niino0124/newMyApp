@extends('layouts.app')
@section('title', '退会ページ')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap">
            <a href="/home" class="btn-simple" >トップに戻る</a>
            <a class="btn-simple" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      
    </div>

    <div class="man-body" >
        <p class="center">退会します。よろしいですか？</p>
        <div class="btn-wrap" >
            <a href="{{route('home.show')}}" class="btn_b btn-back_b">マイページに戻る</a>
            <a href="{{route('home.delete')}}" class="btn_b">退会する</a>
        </div>

    </div>
</div>

@endsection