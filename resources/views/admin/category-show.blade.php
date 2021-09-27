@extends('layouts.app_admin')
@section('title', '商品カテゴリ詳細')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品カテゴリ詳細</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ $back_url }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>
    <div class="man-body_b">
        <form>

            <div class="element_wrap_str">
                <label>商品大カテゴリID</label>
                <p>{{$category->id}}</p>
            </div>

            <div class="element_wrap_str">
                <label>商品大カテゴリ</label>
                <p>{{$category->name}}</p>
            </div>

            <div class="element_wrap_str">
                <label>商品小カテゴリ</label>
                <div class="content-wrap">
                    @foreach ($sub_categories as $sub_category)
                    <p class="sub_name tal">{{$sub_category->name}}</p>
                    @endforeach
                </div>
            </div>


            <div class="">
                <a href="{{route('admin.category-edit',['id' => $category->id])}}" class="btn-back_b">編集</a>
                <a href="{{route('admin.category-delete',['id' => $category->id])}}" class="btn-back_b" >削除</a>
            </div>

        </form>
    </div>
</div>
@endsection
