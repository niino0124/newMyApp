@extends('layouts.app_admin')
@section('title', '会員編集ページ')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">会員編集</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ route('admin.members') }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b ">
        <form method="post" action="{{route('admin.member-edit-confirm')}}" class="">
            @csrf
            @foreach ($member_info as $member)


            <div class="element_wrap_str">
                <label for="id">ID</label>
                <div class="content-wrap">
                    <input id="id" name="id" value="{{ $member->id }}" hidden>
                    {{ $member->id }}
                </div>
            </div>
            <div class="element_wrap">
                <label>氏名</label>
                <label class="name-label" for="name_sei">姓</label>
                <div class="content_wrap">

                    <input id="name_sei" type="text" class=" @error('name_sei') is-invalid @enderror" name="name_sei"
                        value="@if( old('name_sei') ){{ old('name_sei') }} @else {{ $member->name_sei }} @endif">

                    @error('name_sei')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <label class="name-label" for="name_mei">名</label>
                <div class="content-wrap">

                    <input id="name_mei" type="text" class=" @error('name_mei') is-invalid @enderror" name="name_mei"
                        value="@if( old('name_mei') ){{ old('name_mei') }} @else {{ $member->name_mei }} @endif">
                    @error('name_mei')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="element_wrap">
                <label for="nickname">ニックネーム</label>
                <div class="content-wrap">
                    <input id="nickname" type="text" class=" @error('nickname') is-invalid @enderror" name="nickname"
                        value="@if( old('nickname') ){{ old('nickname') }} @else {{ $member->nickname }} @endif">
                    @error('nickname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="element_wrap">
                <label for="gender">性別</label>
                <div class="content-wrap">
                    <div>
                        @foreach(config('master.gender') as $index => $value)
                        <label for="gender">
                            <input value='{{ $index }}' type="radio" class="@error('gender')is-invalid @enderror" name="gender"
                                @if (old('gender')==$index) checked @elseif ($member->gender==$index) checked @endif id="gender">
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if($index == "1") 男性 @else 女性 @endif
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="element_wrap">
                <label for="password">パスワード</label>
                <div class="content-wrap">
                    <input class="" name="original_password" value="{{$member->password}}" hidden>
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password"
                        value="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="element_wrap">
                <label for="password_confirmation">パスワード確認</label>
                <div class="content-wrap">
                    <input id="password-confirm" type="password" class="" name="password_confirmation"
                        value="">
                </div>
            </div>
            <div class="element_wrap">
                <label for="email">メールアドレス</label>
                <div class="content-wrap">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="@if( old('email') ){{ old('email') }} @else {{ $member->email }} @endif">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            @endforeach

            <div class="btn-wrap">
                <input class="btn-back_b" type="submit" value="確認画面へ" />
            </div>
        </form>

    </div>
</div>



@endsection
