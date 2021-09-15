@extends('layouts.app')
@section('title', '商品レビュー編集')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー編集</p>
            <div class="simple-wrap">
                <a href="{{route('home')}}" class="btn-simple">トップに戻る</a>
            </div>
        </div>
    </div>
    @foreach ($infos as $info)


    <div class="man-body-tables" style="padding-top:5px;">
        <ul class="product_lists" style="border-top:none;">
            <li class="product" style="align-items:flex-start;">
                <div class="product_header"><img src="{{ '/storage/' .$info->product->image_1}}" alt="" width="100"
                        height="100"></div>
                <div class="product_body">
                    <div class="left-block">
                        <p class="product_name" style="color: black;">{{ $info->product->name }}</p>
                        <p class="product_star">@if($info->product->getAvgStarAttribute() == 0)評価なし@else 総合評価　 @for($i =
                            0; $i < $info->product->getAvgStarAttribute();
                                $i++)★@endfor　{{ $info->product->getAvgStarAttribute() }}@endif</p>
                    </div>
                </div>
            </li>
        </ul>
        <form method="POST" action="{{route('home.review-edit-confirm')}}">
            @csrf
            <div class="element_wrap_str_review">
                <label for="evaluation" class="evaluation">商品評価</label>
                <div class="content-wrap">
                    <div class="cp_ipselect cp_sl02">
                        <select required name="evaluation">
                            <option value="" hidden>選択してください</option>

                            <option value="5" @if(old('evaluation') == null && $info->evaluation =='5')selected @elseif(old('evaluation') != null && old('evaluation') =='5')  selected @endif>5</option>
                            <option value="4" @if(old('evaluation') == null && $info->evaluation =='4')selected @elseif(old('evaluation') != null && old('evaluation') =='4')  selected @endif>4</option>
                            <option value="3" @if(old('evaluation') == null && $info->evaluation =='3')selected @elseif(old('evaluation') != null && old('evaluation') =='3')  selected @endif>3</option>
                            <option value="2" @if(old('evaluation') == null && $info->evaluation =='2')selected @elseif(old('evaluation') != null && old('evaluation') =='2')  selected @endif>2</option>
                            <option value="1" @if(old('evaluation') == null && $info->evaluation =='1')selected @elseif(old('evaluation') != null && old('evaluation') =='1')  selected @endif>1</option>
                        </select>
                    </div>
                    @error('evaluation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <div class="element_wrap_fill_no_margin">
                <label for="comment" style="margin-right:15px;">商品コメント</label>
                <div class="content-wrap">
                    <textarea id="comment" type="text" class=" @error('comment') is-invalid @enderror" name="comment"
                        style="height: 90px">@if ( old('comment') ){{old('comment')}}
                        @else{{ $info->comment }}@endif</textarea>
                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <input hidden value="{{$info->product->image_1}}" name="image_1">
            <input hidden value="{{$info->product->name}}" name="name">
            <input hidden value="{{$info->product->id}}" name="product_id">
            <input hidden value="{{$info->product->getAvgStarAttribute()}}" name="avg_evaluation">
            <input hidden value="{{$info->id}}" name="id">
            {{-- ブルー --}}
            <div class="btn-wrap">
                <input class="btn_b" type="submit" value="商品レビュー編集確認">
                <a href="{{$back_url}}" class="btn_b btn-back_b">レビュー管理に戻る</a>
            </div>
        </form>
    </div>
    @endforeach
</div>


@endsection
