@extends('layouts.app_admin')
@section('title', '会員一覧')
@section('content')

<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">会員一覧</p>
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
                <a class="btn_b admin_regist" href="{{ route('admin.member-register') }}">会員登録</a>
            </div>

            <form class="search_container search_container_mem" method="GET" action="{{route('admin.members')}}">
                @csrf
                <table class="mem-search">
                    <tr>
                        <th>ID</th>
                        <td><input type="text" name="id" value=""></td>
                    </tr>

                    <tr>
                        <th>性別</th>
                        <td>
                            <div class="table-gender">
                                <li class="table-gender_list"><label for="muhRadio1"><input type="checkbox" name="gender1"
                                            value="1" /> 男性</label></li>
                                <li class="table-gender_list"><label for="muhRadio2"><input type="checkbox" name="gender2"
                                            value="2" /> 女性</label></li>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>フリーワード</th>
                        <td><input type="search" name="search" value=""></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-back_b" name="search_btn" value="検索する">検索する</button>
            </form>
        </div>


        <!-- 何のsessionが保存されているかを確認 -->

        <table class="tabletest_category">
            <tr>
                <th class="t_id">@sortablelink('id', 'ID')</th>
                <th class="t_name">氏名</th>
                <th class="t_email">メールアドレス</th>
                <th class="t_gender">性別</th>
                <th class="t_created_at">@sortablelink('created_at', '登録日時')</th>
                <th class="t_gender">編集</th>
                <th class="t_gender">詳細</th>
            </tr>
            @foreach ($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td><a href="{{route('admin.member-show',['id' => $member->id])}}">{{$member->name_sei}}　{{$member->name_mei}}</a></td>
                <td>{{$member->email}}</td>
                <td>@if ($member->gender == 1)男性 @else 女性
                    @endif</td>
                <td>{{$member->created_at->format('Y/n/j')}}</td>
                <td><a href="{{route('admin.member-edit',['id' => $member->id])}}">編集</a></td>
                <td><a href="{{route('admin.member-show',['id' => $member->id])}}">詳細</a></td>
            </tr>
            @endforeach
        </table>
        <div class="wrap" style="width: 130px;  margin-left:auto; ">
            {{ $members->appends(request()->input())->links() }}

            {{-- {{!! $members->links() !!}}
            {{ $members->appends(request()->query())->links() }} --}}
        </div>
    </div>
</div>
@endsection
