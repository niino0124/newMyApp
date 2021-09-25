@extends('layouts.app_admin')
@section('title', '商品カテゴリ一覧')
@section('content')

<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品カテゴリ一覧</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ route('admin.home') }}">
                    トップへ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b ">
        <div>
            <div class="btn_form">
                <a class="btn_b admin_regist" href="">商品カテゴリ登録</a>
            </div>

            <form class="search_container search_container_mem" method="GET" action="">
                @csrf
                <table class="mem-search">
                    <tr>
                        <th>ID</th>
                        <td><input type="text" name="id" value=""></td>
                    </tr>

                    <tr>
                        <th>フリーワード</th>
                        <td><input type="search" name="search" value=""></td>
                    </tr>

                </table>
                <button type="submit" class="btn btn-back_b" name="search_btn" value="検索する">検索する</button>
            </form>
        </div>


        <table class="tabletest_category">
            <tr>
                <th class="t_id">@sortablelink('id', 'ID')</th>
                <th class="t_email">商品カテゴリ大</th>
                <th class="t_created_at">@sortablelink('created_at', '登録日時')</th>
                <th class="t_gender">編集</th>
                <th class="t_gender">詳細</th>
            </tr>

            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td><a href="">{{$category->name}}</a></td>
                <td>{{$category->created_at->format('Y/n/j')}}</td>
                <td><a href="">編集</a></td>
                <td><a href="">詳細</a></td>
            </tr>
            @endforeach
        </table>

        <div class="wrap" style="width: 130px;  margin-left:auto; ">
            {{ $categories->appends(request()->input())->links() }}
        </div>

    </div>
</div>
@endsection
