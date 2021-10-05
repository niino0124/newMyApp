@extends('layouts.app_admin')
@section('title', '商品レビュー登録・編集確認画面')
@section('content')
{{-- 今のところこのページは編集だけ --}}
<div class="blue-board_admin ">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー編集確認</p>
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
                <div class="product_header"><img src="{{ '/storage/' .$input['image_1']}}" alt="" width="100"
                        height="100"></div>
                <div class="product_body">
                    <div class="left-block">
                        <p class="product_star">商品ID　{{$input['id']}}</p>
                        <p class="product_star">{{$input['name']}}</p>
                        <p class="product_star">@if( $input['avg_evaluation'] == 0 )評価なし@else 総合評価　 @for($i= 0; $i < $input['avg_evaluation']; $i++)★@endfor　{{ $input['avg_evaluation'] }} @endif </p>
                    </div>
                </div>
            </li>
        </ul>
        <form method="POST" action="{{ route('admin.review-edit-complete') }}" style="margin-top: 35px;">
            @csrf
                <div class="element_wrap_str_review">
                    <label class="long_label">ID</label>
                    <div class="content-wrap">
                        <p>{{$input['id']}}</p>
                    </div>
                </div>
                <div class="element_wrap_str_review">
                    <label for="evaluation" class="long_label">商品評価</label>
                    <div class="content-wrap">
                        <p>{{$input['evaluation']}}</p>
                    </div>
                </div>
                <div class="element_wrap_str_review">
                    <label for="comment" class="long_label">商品コメント</label>
                    <div class="content-wrap">
                        <p>{{$input['comment']}}</p>
                    </div>
                </div>
                <input hidden value="{{$input['id']}}" name="id">
                <input hidden value="{{$input['evaluation']}}" name="evaluation">
                <input hidden value="{{$input['comment']}}" name="comment">
                <div class="btn-wrap">
                    @if(isset($input["id"]))<input type="submit" class="btn-back_b"
                        value="編集完了" />@else<input type="submit" class="btn-back_b" value="登録完了" />
                    @endif
                    <input class="btn_b" name="back" value="前に戻る" type="submit">
                </div>
        </form>
        </div>
    </div>
    @endsection
