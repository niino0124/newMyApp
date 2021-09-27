@extends('layouts.app_admin')
@section('title', '会員編集')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">@if($input["id"] != null)
                商品カテゴリ編集確認
            @else 商品カテゴリ登録確認 @endif</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{route('admin.home')}}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        @if ($input["id"] != null)
        <form method="post" action="{{route('admin.category-edit-complete')}}">
            @csrf
            <div class="element_wrap_str">
                <label>商品大カテゴリID</label>
                <p>{{ $input["id"] }}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品大カテゴリ</label>
                <p>{{ $input["name"] }}</p>
            </div>

            <div class="element_wrap_str">
                <label>商品小カテゴリ</label>
                <div class="content-wrap">
                    <p class="sub_name tal">{{ $input["sub_name0"] }}</p>

                    @if ($input["sub_name1"])
                    <p class="sub_name tal">{{ $input["sub_name1"] }}</p>
                    @endif
                    @if ($input["sub_name2"])
                    <p class="sub_name tal">{{ $input["sub_name2"] }}</p>
                    @endif
                    @if ($input["sub_name3"])
                    <p class="sub_name tal">{{ $input["sub_name3"] }}</p>
                    @endif
                    @if ($input["sub_name4"])
                    <p class="sub_name tal">{{ $input["sub_name4"] }}</p>
                    @endif
                    @if ($input["sub_name5"])
                    <p class="sub_name tal">{{ $input["sub_name5"] }}</p>
                    @endif
                    @if ($input["sub_name6"])
                    <p class="sub_name tal">{{ $input["sub_name6"] }}</p>
                    @endif
                    @if ($input["sub_name7"])
                    <p class="sub_name tal">{{ $input["sub_name7"] }}</p>
                    @endif
                    @if ($input["sub_name8"])
                    <p class="sub_name tal">{{ $input["sub_name8"] }}</p>
                    @endif
                    @if ($input["sub_name9"])
                    <p class="sub_name tal">{{ $input["sub_name9"] }}</p>
                    @endif
                </div>

            </div>


            <input value="{{ $input["id"] }}" name="id" hidden>
            <input value="{{ $input["name"] }}" name="name" hidden>
            <input value="{{ $input["sub_name0"] }}" name="sub_name0" hidden>
            <input value="{{ $input["sub_name1"] }}" name="sub_name1" hidden>
            <input value="{{ $input["sub_name2"] }}" name="sub_name2" hidden>
            <input value="{{ $input["sub_name3"] }}" name="sub_name3" hidden>
            <input value="{{ $input["sub_name4"] }}" name="sub_name4" hidden>
            <input value="{{ $input["sub_name5"] }}" name="sub_name5" hidden>
            <input value="{{ $input["sub_name6"] }}" name="sub_name6" hidden>
            <input value="{{ $input["sub_name7"] }}" name="sub_name7" hidden>
            <input value="{{ $input["sub_name8"] }}" name="sub_name8" hidden>
            <input value="{{ $input["sub_name9"] }}" name="sub_name9" hidden>

            {{-- ↑nullが紛れている。コントローラでnull以外！みたいな強力なものがあるかな？ --}}
            <div class="btn-wrap">
                <input type="submit" class="btn-back_b" value="編集完了" />
                <input href="" class="btn_b" name="back" value="前に戻る" type="submit">
            </div>
        </form>


        @else
        {{-- actionに関して@if @else で書き換えできると思うけど --}}
        <form method="post" action="{{route('admin.category-register-complete')}}">
            @csrf
            <div class="element_wrap_str">
                <label>ID</label>
                <p>登録後に自動採番</p>
            </div>





            <div class="btn-wrap">
                <input type="submit" class="btn-back_b" value="登録完了" />
                <input href="{{url()->previous()}}" class="btn_b" name="back" value="前に戻る" type="submit">

            </div>
        </form>
        @endif

    </div>
</div>
@endsection
