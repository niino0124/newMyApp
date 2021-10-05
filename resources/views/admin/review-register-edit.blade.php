@extends('layouts.app_admin')
@section('title', '商品レビュー登録・編集')
@section('content')
{{-- 今のところこのページは編集だけ --}}
<div class="blue-board_admin ">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー編集</p>
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
                        <p class="product_star" style="color: black;">商品ID　{{$review->product->id}}</p>
                        <p class="product_star" style="color: black;">{{$review->product->name}}</p>
                        <p class="product_star">@if($review->product->getAvgStarAttribute() == 0)評価なし@else 総合評価　 @for($i
                            = 0; $i < $review->product->getAvgStarAttribute();
                                $i++)★@endfor　{{ $review->product->getAvgStarAttribute() }}@endif</p>
                    </div>
                </div>
            </li>
        </ul>
        <form method="POST" action="{{ route('product.review-confirm') }}" style="margin-top: 35px;">
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
                    <div class="cp_ipselect cp_sl02">
                        <select name="evaluation">
                            <option value="" hidden>選択してください</option>
                            <option value="5" @if(old('evaluation')=='5' ) selected @elseif(isset($review) && $review->evaluation == '5')selected @endif>5</option>
                            <option value="4" @if(old('evaluation')=='4' ) selected @elseif(isset($review) && $review->evaluation == '4')selected @endif>4</option>
                            <option value="3" @if(old('evaluation')=='3' ) selected @elseif(isset($review) && $review->evaluation == '3')selected @endif>3</option>
                            <option value="2" @if(old('evaluation')=='2' ) selected @elseif(isset($review) && $review->evaluation == '2')selected @endif>2</option>
                            <option value="1" @if(old('evaluation')=='1' ) selected @elseif(isset($review) && $review->evaluation == '1')selected @endif>1</option>
                            {{-- <option value="4" @if(old('evaluation')=='4' ) selected @endif>4</option>
                            <option value="3" @if(old('evaluation')=='3' ) selected @endif>3</option>
                            <option value="2" @if(old('evaluation')=='2' ) selected @endif>2</option>
                            <option value="1" @if(old('evaluation')=='1' ) selected @endif>1</option> --}}
                        </select>
                    </div>
                    @error('evaluation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="element_wrap_str_review">
                <label for="comment" class="long_label">商品コメント</label>
                <div class="content-wrap">
                    <textarea class="@error('comment') is-invalid @enderror" name="comment"
                        style="height: 90px">@if (old('comment')){{ old('comment') }}@elseif(isset($review)){{$review->comment}}@endif</textarea>

                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>

            <input hidden value="{{$review->image_1}}" name="image_1">
            <input hidden value="{{$review->name}}" name="name">
            <input hidden value="{{$review->id}}" name="product_id">
            <input hidden value="{{$review->product->getAvgStarAttribute()}}" name="avg_evaluation">

            <div class="btn-wrap">
                <input class="btn_b" type="submit" value="確認画面へ">
            </div>
        </form>
    </div>
</div>


@endsection
