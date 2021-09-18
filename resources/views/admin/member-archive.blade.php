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
                                <li class="table-gender_list"><label for="muhRadio1"><input type="radio" name="gender"
                                            value="1" /> 男性</label></li>
                                <li class="table-gender_list"><label for="muhRadio2"><input type="radio" name="gender"
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

        <table class="tabletest">
            <tr>
                <th class="t_id">ID
                    {{-- action="{{route('admin.members')}}" --}}
                    <form class="form_sp" method="get" action="">
                        <input type="submit" name='order' id="asc" value="昇順" class="asc">
                        <input type="submit" name='order' id="desc" class="desc" value="降順" data-id='desc'>
                    </form>

                    </form>
                </th>
                <th class="t_name">氏名</th>
                <th class="t_email">メールアドレス</th>
                <th class="t_gender">性別</th>
                <th class="t_created_at">登録日時 <form class="form_sp" method="get">
                        {{-- <input type="submit" name='desc' id="desc" value="昇順"> --}}
                        {{-- <input type="submit" name='asc' id="asc" value="降順"> --}}
                        <input type="submit" value="▲" class="asc">
                    </form>
                </th>
                {{-- <th class="t_gender">編集</th>
                    <th class="t_gender">詳細</th> --}}
            </tr>
            @foreach ($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->name_sei}}　{{$member->name_mei}}</td>
                <td><a href="" class="edit">{{$member->email}}</a></td>
                <td>@if ($member->gender == 1)男性 @else 女性
                    @endif</td>
                <td>{{$member->created_at->format('Y/n/j')}}</td>
                {{-- <td><a href="" class="edit">編集</a></td>
                    <td><a href="" class="edit">詳細</a></td> --}}
            </tr>
            @endforeach
        </table>
        <div class="wrap" style="width: 130px;  margin-left:auto; ">
            {{ $members->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{{-- jQuery --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            var asc = '<input type="submit" name="asc" id="asc" value="▲" class="asc">',
                desc = '<input type="submit" name="desc" id="desc"  value="▼" class="desc">';
            $("#id_order").on('submit', function(e){
                $(".asc").hide();
                $(".form_sp").append(desc);
        });
            $(".desc").on('submit', function(e){
                $(".desc").hide();
                $(".form_sp").append(asc);
        });
    });
    </script> --}}
@endsection
