@extends('layouts.app')
@section('title', '会員情報変更ページ')
@section('content')
<form method="post" action="{{ route('home.edit-profile-post') }}" class="block-b">
    @csrf
<h1>会員情報変更</h1>
<div class="element_wrap">
    <label>氏名</label>
    <label class="name-label" for="name_sei">姓</label>
    <div class="content_wrap">

        <input id="name_sei" type="text" class=" @error('name_sei') is-invalid @enderror" name="name_sei" value="@if( old('name_sei') != null ){{old('name_sei')}} @else {{ Auth::user()->name_sei }}@endif" >

        @error('name_sei')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>

    <label class="name-label" for="name_mei">名</label>
    <div class="content-wrap">

        <input id="name_mei" type="text" class=" @error('name_mei') is-invalid @enderror" name="name_mei" value="@if( old('name_mei') != null ){{old('name_mei')}}@else{{ Auth::user()->name_mei }}@endif">
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
            <input id="nickname" type="text" class=" @error('nickname') is-invalid @enderror" name="nickname" value="@if( old('nickname') != null ){{old('nickname')}}@else{{ Auth::user()->nickname }}@endif" >
            @error('nickname')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>
{{-- value="@if( old('name_sei') != null ){{old('name_sei')}}@else{{ Auth::user()->name_sei }}@endif" --}}
<div class="element_wrap">
    <label for="gender">性別</label>
    <div class="content-wrap">
            <div>
                    @foreach(config('master.gender') as $index => $value)
                    <label>
                            <input value='{{ $index }}'
                            type="radio"  class="@error('gender') is-invalid @enderror" name="gender" @if(old('gender') != null && old('gender') == $index) checked @elseif( Auth::user()->gender == $index) checked @endif >
                            @if($index == "1") 男性 @else 女性 @endif
                            {{-- <input value='{{ $index }}'
                            type="radio"  class="@error('gender')is-invalid @enderror" name="gender" @if( Auth::user()->gender == $index) checked @endif >
                            @if($index == "1") 男性 @else 女性 @endif --}}
                    </label>
                    @endforeach
                </div>
                @error('gender')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
</div>
<div class="btn-wrap">
    <input class="btn" type="submit" value="確認画面へ" />
    <a href="{{route('home.show')}}" class="btn btn-back">マイページに戻る</a>
</div>
</form>

@endsection
