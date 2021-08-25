@extends('layouts.app')
@section('title', '商品登録')
@section('content')
<form method="post" action="{{route('product.create')}}" enctype="multipart/form-data" class="block-b">
    @csrf
<h1>商品登録</h1>
<div class="element_wrap">
    <label for="name">商品名</label>
    <div class="content-wrap">
            <input id="name" type="text" class=" @error('name') is-invalid @enderror long" name="name" value="{{ old('name') }}" >
            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>

<div class="element_wrap ajax_wrap">
    <div class="content_wrap_v" >
        <label for="product_category" class="product_category">商品カテゴリ

            <select name="product_category_id" id="product_category_id">
                <option value="">選択してください</option>
                @foreach ($product_categories as $product_category)
                <option value="{{$product_category->id}}">{{$product_category->name}}</option>
                <br>
                @endforeach
            </select>

            {{-- <div class="ajax_op_wrap">
    </div> --}}
        <select name="product_subcategory_id" id="product_subcategory_id">
            <option value="" class="op_aj" id="children">選択してください</option>
        </select>

            {{-- <select name="product_subcategory_id" id="product_subcategory_id">
            <option value="">選択してください</option>
            <option value="{{$product_subcategory->id}}">{{$product_subcategory->name}}</option>
            </select> --}}
        </label>
    </div>
</div>



<div class="element_wrap">
    <div class="relative">
        <label for="image" class="leading-7 text-sm text-gray-600">商品写真</label>
        <label class="image_label">
            写真１
            <div id="preview"></div>
            <label for="" class="file_design">
                <input type="file" id="image" name="image" accept=“image/png,image/jpeg,image/jpg” >
                アップロード
            </label>
        </label>
    </div>
</div>

<div class="element_wrap">
    <label for="product_content">商品説明</label>
    <div class="content-wrap">
            <textarea id="product_content" type="product_content" class=" @error('product_content') is-invalid @enderror" name="product_content" style="height: 90px">{{ old('product_content') }}</textarea>
            @error('product_content')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
    @enderror
    </div>
</div>


<div class="btn-wrap">
    <input class="btn" type="submit" value="確認画面へ" />
    <a href="/" class="btn btn-back">トップに戻る</a>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $('#product_subcategory_id').hide();

    $('#product_category_id').change(function() {
        $('#product_subcategory_id').hide();
        $('#product_subcategory_id option').remove('.add_op');


        let id = $('option:selected').val();//カテゴリIDを取得
        console.log(id);

    $.ajax({
        
        type: 'GET',
        url:"/product/index/" + id , //通信したいURL
        dataType: 'json', //json形式で受け取る

        }).done(function (data) {

            $('#product_subcategory_id').show();
                $.each(data, function (index, value) {
                let id = value.id;
                let name = value.name;
                $('#product_subcategory_id').append($('<option>').text(name).attr({value: id,class:'add_op'}));
                })

            }).fail(function () {
                console.log('どんまい！');
            });
    })
</script>













//   function previewFile(file) {
//   // プレビュー画像を追加する要素
//   const preview = document.getElementById('preview');

//   // FileReaderオブジェクトを作成
//   const reader = new FileReader();

//   // URLとして読み込まれたときに実行する処理
//   reader.onload = function (e) {
//     const imageUrl = e.target.result; // URLはevent.target.resultで呼び出せる
//     const img = document.createElement("img"); // img要素を作成
//     img.src = imageUrl; // URLをimg要素にセット
//     preview.appendChild(img); // #previewの中に追加
//   }

//   // いざファイルをURLとして読み込む
//   reader.readAsDataURL(file);
// }
// // <input>でファイルが選択されたときの処理
// const fileInput = document.getElementById('image');
// const handleFileSelect = () => {
//   const files = fileInput.files;
//   for (let i = 0; i < files.length; i++) {
//     previewFile(files[i]);
//   }
// }
// fileInput.addEventListener('change', handleFileSelect);


@endsection
