@extends('layouts.app_admin')
@section('title', '商品レビュー詳細')
@section('content')
{{-- 今のところこのページは編集だけ --}}
<div class="blue-board_admin ">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー詳細</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ $back_url }}">
                    トップへ戻る
                </a>
            </div>
        </div>
    </div>

    <div class="mab-body_review">
        <ul class="product_lists" style="border-top:none;">
            <li class="product" style="align-items:center; padding:15px 20px;">
                <div class="product_header"><img src="{{ '/storage/' .$review->product->image_1}}" alt="" width="100"
                        height="100"></div>
                <div class="product_body">
                    <div class="left-block">
                        <p class="product_star">商品ID　{{$review->product->id }}</p>
                        <p class="product_star">{{ $review->product->name }}</p>
                        <p class="product_star">@if( $review->product->getAvgStarAttribute() == 0 )評価なし@else 総合評価　 @for($i= 0; $i < $review->product->getAvgStarAttribute(); $i++)★@endfor　{{ $review->product->getAvgStarAttribute() }} @endif </p>
                    </div>
                </div>
            </li>
        </ul>
        <form method="POST" action="{{ route('admin.review-edit-complete') }}" style="margin-top: 35px;">
            @csrf
                <div class="element_wrap_str_review">
                    <label class="long_label">ID</label>
                    <div class="content-wrap">
                        <p>{{$review->id}}</p>
                    </div>
                </div>
                <div class="element_wrap_str_review">
                    <label for="evaluation" class="long_label">商品評価</label>
                    <div class="content-wrap">
                        <p>{{$review->evaluation}}</p>
                    </div>
                </div>
                <div class="element_wrap_str_review">
                    <label for="comment" class="long_label">商品コメント</label>
                    <div class="content-wrap">
                        <p style="width:200px;" class="tal">{{$review->comment}}</p>
                    </div>
                </div>

                <div class="">
                    <a href="{{route('admin.review-edit',['id' => $review->id])}}" class="btn-back_b">編集</a>
                    <a href="{{route('admin.review-delete',['id' => $review->id])}}" class="btn-back_b" >削除</a>
                </div>
        </form>
        </div>
    </div>
    @endsection
