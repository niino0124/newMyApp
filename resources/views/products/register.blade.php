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

                <option value="{{$product_category->id}}" @if(old('product_category_id') == $product_category->id) selected @endif >{{$product_category->name}}</option>

                @endforeach
            </select>

            <select name="product_subcategory_id" id="product_subcategory_id">
                <option value="" class="op_aj" id="children">選択してください</option>
            </select>

            {{-- 確認画面から戻ってきた場合 --}}
            @if (null !== old('product_subcategory_id') )
            <select name="product_subcategory_id" id="product_subcategory_id_old">
                <option value="" class="op_aj" id="children">選択してください</option>

                @foreach ($old_product_subcategory_infos as $old_product_subcategory_info)

                <option value="{{ $old_product_subcategory_info->id }}" class="op_aj" id="children" @if ($old_product_subcategory_info->id == old('product_subcategory_id'))
selected
                @endif>{{ $old_product_subcategory_info->name }}</option>

                @endforeach
            </select>
            @endif




        </label>
    </div>
</div>



<div class="element_wrap">
    <div class="relative">
        <label for="image" class="leading-7 text-sm text-gray-600">商品写真</label>
        <label class="image_label">
            写真１
            <div id="preview"></div>
            <label for="image_1" class="file_design">
                <input type="file" id="image" name="image_1" accept=“image/png,image/jpeg,image/jpg” >
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

// 初期状態ではサブカテゴリ欄は隠しておく
    $('#product_subcategory_id').hide();

// カテゴリ欄に変更があった時の処理
    $('#product_category_id').change(function() {

        // もし前に選択したサブカテゴリ欄が残っていれば隠す
        $('#product_subcategory_id').hide();
        $('#product_subcategory_id_old').hide();

        // もし前に選択したサブカテゴリの選択肢群があれば削除
        $('#product_subcategory_id option').remove('.add_op');
        $('#product_subcategory_id_old option').remove('.op_aj');

        //選択したカテゴリIDを取得
        let id = $('option:selected').val();


        // IDをもとに、サブカテゴリ欄を表示、選択肢群を追加
    $.ajax({

        type: 'GET',
        url:"/product/index/" + id ,
        dataType: 'json',

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








  function previewFile(file) {
  // プレビュー画像を追加する要素
  const preview = document.getElementById('preview');

  // FileReaderオブジェクトを作成
  const reader = new FileReader();

  // URLとして読み込まれたときに実行する処理
  reader.onload = function (e) {
    const imageUrl = e.target.result; // URLはevent.target.resultで呼び出せる
    const img = document.createElement("img"); // img要素を作成
    img.src = imageUrl; // URLをimg要素にセット
    preview.appendChild(img); // #previewの中に追加
  }

  // いざファイルをURLとして読み込む
  reader.readAsDataURL(file);
}
// <input>でファイルが選択されたときの処理
const fileInput = document.getElementById('image');
const handleFileSelect = () => {
  const files = fileInput.files;
  for (let i = 0; i < files.length; i++) {
    previewFile(files[i]);
  }
}
fileInput.addEventListener('change', handleFileSelect);


</script>













@endsection
