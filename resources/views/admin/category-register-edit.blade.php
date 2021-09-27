@extends('layouts.app_admin')
@section('title', ' 商品カテゴリ登録・編集ページ')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">
                @if ($category != null )
                商品カテゴリ編集 @else 商品カテゴリ登録 @endif</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ $back_url }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b ">
        @if ($category != null )
        <form method="post" action="{{route('admin.category-edit-confirm')}}">
            @csrf
            <div class="element_wrap_str">
                <label for="id">商品大カテゴリID</label>
                <div class="content-wrap">
                    {{ $category->id }}
                    <input value="{{ $category->id }}" name="id" hidden>
                </div>
            </div>
            <div class="element_wrap">
                <label>商品大カテゴリ</label>
                <div class="content-wrap">
                    <input id="name" type="text" class=" @error('name') is-invalid @enderror long" name="name"
                        value="{{ $category->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="element_wrap">
                <label>商品小カテゴリ</label>
                <div class="content-wrap">

                    <input type="text" class=" @error('sub_name0') is-invalid @enderror long sub_name" name="sub_name0"
                    value="@if ( isset($subcategory[0]->name)) {{$subcategory[0]->name}} @else {{old('sub_name0')}}
                    @endif">
                    @error('sub_name0')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name1') is-invalid @enderror long sub_name" name="sub_name1"
                    value="@if ( isset($subcategory[1]->name)) {{$subcategory[1]->name}} @else {{old('sub_name1')}}
                    @endif">
                    @error('sub_name1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name2') is-invalid @enderror long sub_name" name="sub_name2"
                    value="@if ( isset($subcategory[2]->name)) {{$subcategory[2]->name}} @else {{old('sub_name2')}}
                    @endif">
                    @error('sub_name2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name3') is-invalid @enderror long sub_name" name="sub_name3"
                    value="@if ( isset($subcategory[3]->name)) {{$subcategory[3]->name}} @else {{old('sub_name3')}}
                    @endif">
                    @error('sub_name3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name4') is-invalid @enderror long sub_name" name="sub_name4"
                    value="@if ( isset($subcategory[4]->name)) {{$subcategory[4]->name}} @else {{old('sub_name4')}}
                    @endif">
                    @error('sub_name4')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name5') is-invalid @enderror long sub_name" name="sub_name5"
                    value="@if ( isset($subcategory[5]->name)) {{$subcategory[5]->name}} @else {{old('sub_name5')}}
                    @endif">
                    @error('sub_name5')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name6') is-invalid @enderror long sub_name" name="sub_name6"
                    value="@if ( isset($subcategory[6]->name)) {{$subcategory[6]->name}} @else {{old('sub_name6')}}
                    @endif">
                    @error('sub_name6')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name7') is-invalid @enderror long sub_name" name="sub_name7"
                    value="@if ( isset($subcategory[7]->name)) {{$subcategory[7]->name}} @else {{old('sub_name7')}}
                    @endif">
                    @error('sub_name7')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name8') is-invalid @enderror long sub_name" name="sub_name8"
                    value="@if ( isset($subcategory[8]->name) ) {{$subcategory[8]->name}} @else {{old('sub_name8')}}
                    @endif">
                    @error('sub_name8')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name9') is-invalid @enderror long sub_name" name="sub_name9"
                    value="@if (isset($subcategory[9]->name)) {{$subcategory[9]->name}} @else {{old('sub_name9')}}
                    @endif">
                    @error('sub_name9')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name10') is-invalid @enderror long sub_name" name="sub_name10"
                    value="@if (isset($subcategory[10]->name)) {{$subcategory[10]->name}} @else {{old('sub_name10')}}
                    @endif">
                    @error('sub_name10')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>
            <div class="btn-wrap">
                <input class="btn-back_b" type="submit" value="確認画面へ" />
            </div>
        </form>


        @else
        <form method="post" action="{{route('admin.category-register-confirm')}}" class="">
            @csrf
            <div class="element_wrap_str">
                <label for="id">商品大カテゴリID</label>
                <div class="content-wrap">
                    登録後に自動採番
                </div>
            </div>

            <div class="element_wrap">
                <label for="name">商品大カテゴリ</label>
                <div class="content-wrap">
                    <input id="name" type="text" class=" @error('name') is-invalid @enderror long" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="element_wrap">
                <label for="name">商品小カテゴリ</label>
                <div class="content-wrap">

                    <input type="text" class=" @error('sub_name1') is-invalid @enderror long" name="sub_name1"
                        value="{{ old('sub_name1') }}">
                    @error('sub_name1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name2') is-invalid @enderror long" name="sub_name2"
                        value="{{ old('sub_name2') }}">
                    @error('sub_name2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name3') is-invalid @enderror long" name="sub_name3"
                        value="{{ old('sub_name3') }}">
                    @error('sub_name3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name4') is-invalid @enderror long" name="sub_name4"
                        value="{{ old('sub_name4') }}">
                    @error('sub_name4')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name4') is-invalid @enderror long" name="sub_name5"
                        value="{{ old('sub_name5') }}">
                    @error('sub_name5')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name6') is-invalid @enderror long" name="sub_name6"
                        value="{{ old('sub_name6') }}">
                    @error('sub_name6')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name7') is-invalid @enderror long" name="sub_name7"
                        value="{{ old('sub_name7') }}">
                    @error('sub_name7')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name8') is-invalid @enderror long" name="sub_name8"
                        value="{{ old('sub_name8') }}">
                    @error('sub_name8')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input type="text" class=" @error('sub_name9') is-invalid @enderror long" name="sub_name9"
                        value="{{ old('sub_name9') }}">
                    @error('sub_name9')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>

            <div class="btn-wrap">
                <input class="btn-back_b" type="submit" value="確認画面へ" />
            </div>

        </form>
        @endif

    </div>
</div>



@endsection
