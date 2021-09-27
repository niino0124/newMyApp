@extends('layouts.app_admin')
@section('title', '会員編集')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">@if(isset($input["id"]))
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
        <form method="post" action="@if(isset($input["id"])){{route('admin.category-edit-complete')}}@else{{route('admin.category-register-complete')}}@endif">
            @csrf
            <div class="element_wrap_str">
                <label>商品大カテゴリID</label>
                <p>@if(isset($input["id"])){{ $input["id"] }}@else 登録後に自動採番 @endif</p><input value="@if (isset($input["id"])){{ $input["id"] }}@else @endif" name="id" hidden>
            </div>
            <div class="element_wrap_str">
                <label>商品大カテゴリ</label>
                <p>{{ $input["name"] }}</p><input value="{{ $input["name"] }}" name="name" hidden>

            </div>

            <div class="element_wrap_str">
                <label>商品小カテゴリ</label>
                <div class="content-wrap">
                    <p class="sub_name_b tal">{{ $input["sub_name0"] }}</p>            <input value="{{ $input["sub_name0"] }}" name="sub_name0" hidden>


                    @if ($input["sub_name1"])
                    <p class="sub_name_b tal">{{ $input["sub_name1"] }}</p>            <input value="{{ $input["sub_name1"] }}" name="sub_name1" hidden>

                    @endif
                    @if ($input["sub_name2"])
                    <p class="sub_name_b tal">{{ $input["sub_name2"] }}</p>            <input value="{{ $input["sub_name2"] }}" name="sub_name2" hidden>

                    @endif
                    @if ($input["sub_name3"])
                    <p class="sub_name_b tal">{{ $input["sub_name3"] }}</p>            <input value="{{ $input["sub_name3"] }}" name="sub_name3" hidden>

                    @endif
                    @if ($input["sub_name4"])
                    <p class="sub_name_b tal">{{ $input["sub_name4"] }}</p>            <input value="{{ $input["sub_name4"] }}" name="sub_name4" hidden>

                    @endif
                    @if ($input["sub_name5"])
                    <p class="sub_name_b tal">{{ $input["sub_name5"] }}</p>            <input value="{{ $input["sub_name5"] }}" name="sub_name5" hidden>

                    @endif
                    @if ($input["sub_name6"])
                    <p class="sub_name_b tal">{{ $input["sub_name6"] }}</p>            <input value="{{ $input["sub_name6"] }}" name="sub_name6" hidden>

                    @endif
                    @if ($input["sub_name7"])
                    <p class="sub_name_b tal">{{ $input["sub_name7"] }}</p>
                    <input value="{{ $input["sub_name7"] }}" name="sub_name7" hidden>
                    @endif
                    @if ($input["sub_name8"])
                    <p class="sub_name_b tal">{{ $input["sub_name8"] }}</p>
                    <input value="{{ $input["sub_name8"] }}" name="sub_name8" hidden>
                    @endif
                    @if ($input["sub_name9"])
                    <p class="sub_name_b tal">{{ $input["sub_name9"] }}</p>
                    <input value="{{ $input["sub_name9"] }}" name="sub_name9" hidden>
                    @endif
                </div>
            </div>


            <div class="btn-wrap">
                @if(isset($input["id"]))<input type="submit" class="btn-back_b" value="編集完了" />@else<input type="submit" class="btn-back_b" value="登録完了" /> @endif
                <input href="{{url()->previous()}}" class="btn_b" name="back" value="前に戻る" type="submit">
            </div>



        </form>
    </div>
</div>
@endsection
