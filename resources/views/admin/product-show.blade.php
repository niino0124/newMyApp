@extends('layouts.app_admin')
@section('title', '商品詳細')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品詳細</p>
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
                <label>商品ID</label>
                <p>{{$product->id}}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品名</label>
                <p>{{$product->name}}</p>
            </div>
            <div class="element_wrap_str">
                <label>商品カテゴリ</label>
                <p>{{$product->productCategory->name}} > {{$product->productSubcategory->name}}</p>
            </div>

            @if (isset($product->image_1) || isset($product->image_2)|| isset($product->image_3) || isset($product->image_4))
            <div class="element_wrap_str">
                <label>商品写真</label>
                <div class="">
                    @if(isset($product->image_1))
                    <div class="view_box">
                        <label class="image_label">写真１</label>
                        <img src="{{ '/storage/' . $product->image_1}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if(isset($product->image_2))
                    <div class="view_box">
                        <label class="image_label">写真２</label>
                        <img src="{{ '/storage/' . $product->image_2}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if(isset($product->image_3))
                    <div class="view_box">
                        <label class="image_label">写真３</label>
                        <img src="{{ '/storage/' . $product->image_3}}" class=''  width="150" height="150"/>
                    </div>
                    @endif

                    @if(isset($product->image_4))
                    <div class="view_box">
                        <label class="image_label">写真４</label>
                        <img src="{{ '/storage/' . $product->image_4}}" class=''  width="150" height="150"/>
                    </div>
                    @endif
                </div>
            </div>
            <div class="element_wrap_str">
                <label>商品説明</label>
                <p>{{ $product->product_content }}</p>
            </div>


            <div class="product_body_b">
                {{-- <p class="fw-bold">{{ $product['name'] }}</p> --}}
                <p class="product_star_b fw-bold" >総合評価　@for($i = 0; $i < $product->getAvgStarAttribute(); $i++)★@endfor {{$product->getAvgStarAttribute()}}</p>
            </div>

            <ul class="product_lists" style="border-top:none;">
                @foreach ($reviews as $review)
                <li class="product">
                    <div class="product_header comment_header">
                        <p class="comment_content fw-bold">商品レビューID</p>
                        <p class="who "><a class="edit fw-light"  href="{{route('admin.member-show',['id' => $review->member->id])}}">{{$review->member->nickname}}さん</a></p>
                        <p class="comment_content">商品コメント</p>
                    </div>

                    <div class="product_body" style="margin-left: 25px;width:300px;margin-right:20px;">
                        <div class="left-block">
                            <p class="fw-bold">{{$review->id}}</p>
                            <p style="margin-top: 10px;">@for($i = 0; $i < $review->evaluation; $i++)★@endfor　{{$review->evaluation}}</p>
                            <p style="margin-top: 10px;">{{$review->comment}}</p>
                        </div>
                    </div>
                    <div class="product_foot">
                        <a class="btn-simple_sm" >商品レビュー詳細</a>
                    </div>
                </li>
                @endforeach
            </ul>
            {{ $reviews->appends(request()->input())->links() }}

            @endif
            <div class="">
                <a href="{{route('admin.product-edit',['id' => $product->id])}}" class="btn-back_b">編集</a>
                <a href="{{route('admin.product-delete',['id' => $product->id])}}" class="btn-back_b" >削除</a>
            </div>

        </form>
    </div>
</div>
@endsection
