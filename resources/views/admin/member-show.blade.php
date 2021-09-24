@extends('layouts.app_admin')
@section('title', '会員詳細')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">会員詳細</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ $back_url }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        <form>
            @foreach ($member_info as $member)
            <div class="element_wrap_str">
                <label>ID</label>
                <p>{{$member->id}}</p>
            </div>
            <div class="element_wrap_str">
                <label>氏名</label>
                <p>{{$member->name_sei}}　{{$member->name_mei}}</p>
            </div>
            <div class="element_wrap_str">
                <label>ニックネーム</label>
                <p>{{$member->nickname}}</p>
            </div>
            <div class="element_wrap_str">
                <label>性別</label>
                <p> @if( $member->gender == "1")男性 @else 女性@endif</p>
            </div>
            <div class="element_wrap_str">
                <label>パスワード</label>
                <p>セキュリティのため非表示</p>
            </div>
            <div class="element_wrap_str">
                <label>メールアドレス</label>
                <p>{{$member->email}}</p>
            </div>
            <div class="">
                <a href="{{route('admin.member-edit',['id' => $member->id])}}" class="btn-back_b">編集</a>
                <a href="{{route('admin.member-delete',['id' => $member->id])}}" class="btn-back_b" >削除</a>
            </div>
            @endforeach

        </form>
    </div>
</div>
@endsection
