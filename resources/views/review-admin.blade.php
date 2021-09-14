@extends('layouts.app')
@section('title', '商品レビュー管理')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品レビュー管理</p>
            <div class="simple-wrap">
                @auth
                <a class="btn-simple" href="{{route('home')}}">
                    トップに戻る
                </a>
                @endauth
            </div>
        </div>
    </div>
    <div class="man-body-tables">
        <ul class="product_lists">
            @foreach ($reviews as $review)
{{-- {{dd($review)}} --}}
                <li class="product">
                    <div class="product_header"><img src="{{ '/storage/' .$review->product->image_1}}" alt="" width="100" height="100"></div>
                    <div class="product_body">
                        <div class="left-block"><p class="cat">{{ $review->product->productCategory->name }}＞{{ $review->product->productSubcategory->name }}</p></div>
                        <a href="" ><p class="product_name" >{{$review->product->name}}</p>
                        </a>
                        <p class="product_star">@if($review->evaluation == 0)評価なし@else @for($i = 0; $i < $review->evaluation; $i++)★@endfor　{{$review->evaluation}}</p>
                        <p class="product_comment">{{$review->comment}}@endif</p>
                        <div class="product_category" style="justify-content: flex-start">
                            <a href="{{route('home.review-edit',['id' => $review->id])}}" class="blue_btn">レビュー編集</a>
                            <a href="" class="blue_btn">レビュー削除</a>
                        </div>
                    </div>
                </li>

            @endforeach
        </ul>
        {{ $reviews->appends(request()->input())->links() }}


        <div class="btn-wrap">
            <a href="{{route('home.show')}}" class="btn btn-back-bl" >マイページに戻る</a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- カテゴリ・サブカテゴリ --}}
<script>
    $(function() {


        // カテゴリ欄に変更があった時の処理
        $('#product_category_id').change(function() {
        console.log('変化あり！');
        // もし前に選択したサブカテゴリ欄が残っていれば隠す
        $('.add_op').remove();

        //選択したカテゴリIDを取得
        let id = $('option:selected').val();
        console.log(id);



        // IDをもとに、サブカテゴリ欄を表示、選択肢群を追加
            $.ajax({
            type: 'GET',
            url:"/review/list/" + id ,
            dataType: 'json',

            }).done(function (data) {
                    $.each(data, function (index, value) {
                    let id = value.id;
                    let name = value.name;
                    $('#product_subcategory_id').append($('<option>').text(name).attr({value: id,class:'add_op'}));
                    })

                }).fail(function () {
                    console.log('どんまい！');
                });

    });
    });
</script>
@endsection
