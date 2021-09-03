@extends('layouts.app')
@section('title', 'トップページ（ログイン状態時）')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品一覧</p>
            <div class="simple-wrap">

                <a class="btn-simple" href="{{route('product.index')}}">
                    新規商品登録
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    @foreach ($products as $product)
    <p>{{$product->name}}</p>
    @endforeach

    <div class="man-body-tables">
        <form class="search-wrap" method="GET" action="{{route('product.list')}}">
            @csrf
            <label for="">カテゴリ
                <select name="product_category_id" id="product_category_id">
                    <option value="0">カテゴリ</option>
                    @foreach ($product_categories as $product_category)
                    <option value="{{$product_category->id}}" @if(old('product_category_id')==$product_category->id)
                        selected @endif >{{$product_category->name}}</option>
                    @endforeach
                </select>

                <select name="product_subcategory_id" id="product_subcategory_id">
                    <option value="">サブカテゴリ</option>
                    @foreach ($product_subcategories as $product_subcategory)
                    <option value="{{$product_category->id}}" @if(old('product_subcategory_id')==$product_subcategory->
                        id)
                        selected @endif class="add_op">{{$product_subcategory->name}}</option>
                    @endforeach
                </select>

            </label>
            <label for="">フリーワード
                <input type="search" class="long" name="search">
            </label>
            <button type="submit" class="btn-simple">商品検索</button>
        </form>


        <ul class="product_lists">
            <li class="product">
                <div class="product_header"><img src="" alt=""></div>
                <div class="product_body">
                    <p class="cat">大カテゴリー＞小カテゴリー</p>
                    <p class="product_name">商品名</p>
                </div>
            </li>
        </ul>


        <ul class="example">
            <li class=" t_next"><a class="" href="#">＜前へ</a></li>
            <li class=""><a class=" this" href="#">1</a></li>
            <li class=""><a class="" href="#">2</a></li>
            <li class=""><a class="" href="#">3</a></li>
            <li class="t_next"><a class="" href="#">次へ＞</a></li>
        </ul>

        <div class="btn-wrap">
            <a href="/" class="btn btn-back-bl" s>トップに戻る</a>
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
            url:"/product/list/" + id ,
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
