@extends('layouts.app_admin')
@section('title', '商品登録編集フォーム・確認')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">@if (!isset($data["id"]))商品登録確認@else 商品編集確認@endif </p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{route('admin.products')}}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        @if (!isset($data["id"]))
        <form method="post" action="{{route('admin.product-register-complete')}}">
            @csrf
            <div class="element_wrap_str">
                <label>ID</label>
                <p>登録後に自動採番</p>
            </div>
            <div class="element_wrap_str">
                <label>商品名</label>
                <p>{{ $data["name"] }}</p>
            </div>

            <div class="element_wrap_str">
                <label>商品カテゴリ</label>
                <p>{{ $category->name }} ＞ {{ $sub_category->name }}</p>
            </div>

            @if($data['path1'] !== NULL || $data['path2'] !== NULL|| $data['path3'] !== NULL|| $data['path4'] !== NULL)

                <div class="element_wrap_str">
                    <label>商品写真</label>
                    <div class="">
                        @if($data['path1'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真１</label>
                            <img src="{{ '/storage/' . $data['path1']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif

                        @if($data['path2'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真２</label>
                            <img src="{{ '/storage/' . $data['path2']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif

                        @if($data['path3'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真３</label>
                            <img src="{{ '/storage/' . $data['path3']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif

                        @if($data['path4'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真４</label>
                            <img src="{{ '/storage/' . $data['path4']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif
                    </div>
                </div>
            @endif



            <div class="element_wrap_str">
                <label>商品説明</label>
                <p>{{ $data["product_content"] }}</p>
            </div>

            <div class="btn-wrap">
                @if(isset($input["id"]))<input type="submit" class="btn-back_b" value="編集完了" />@else<input type="submit" class="btn-back_b" value="登録完了" /> @endif
                <input class="btn_b" name="back" value="前に戻る" type="submit">
            </div>

        </form>
        @else
        <form method="post" action="{{route('admin.product-edit-complete')}}">
            @csrf
            <div class="element_wrap_str">
                <label>ID</label>
                <p>{{ $data["id"] }}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品名</label>
                <p>{{ $data["name"] }}</p>
            </div>

            <div class="element_wrap_str">
                <label>商品カテゴリ</label>
                <p>{{ $category->name }} ＞ {{ $sub_category->name }}</p>
            </div>

            @if($data['path1'] !== NULL || $data['path2'] !== NULL|| $data['path3'] !== NULL|| $data['path4'] !== NULL)

                <div class="element_wrap_str">
                    <label>商品写真</label>
                    <div class="">
                        @if($data['path1'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真１</label>
                            <img src="{{ '/storage/' . $data['path1']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif

                        @if($data['path2'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真２</label>
                            <img src="{{ '/storage/' . $data['path2']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif

                        @if($data['path3'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真３</label>
                            <img src="{{ '/storage/' . $data['path3']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif

                        @if($data['path4'] !== NULL)
                        <div class="view_box">
                            <label class="image_label">写真４</label>
                            <img src="{{ '/storage/' . $data['path4']}}" class=''  width="150" height="150"/>
                        </div>
                        @endif
                    </div>
                </div>
            @endif



            <div class="element_wrap_str">
                <label>商品説明</label>
                <p>{{ $data["product_content"] }}</p>
            </div>

            <div class="btn-wrap">
                @if(isset($input["id"]))<input type="submit" class="btn-back_b" value="編集完了" />@else<input type="submit" class="btn-back_b" value="登録完了" /> @endif
                <input class="btn_b" name="back" value="前に戻る" type="submit">
            </div>

        </form>
        @endif
    </div>
</div>
@endsection
