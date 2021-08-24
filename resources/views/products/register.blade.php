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

<div class="element_wrap">
    <div class="content_wrap_v" >
        <label for="product_category" >商品カテゴリ
            <select name="product_category_id" onChange="
            event.preventDefault();
            ">
                <option value="">選択してください</option>
                @foreach ($product_categories as $product_category)
                <option value="{{$product_category->id}}">{{$product_category->name}}</option>
                <br>
                @endforeach
            </select>

            <select name="product_subcategory_id" >
                <option value="">選択してください</option>
                @foreach ($product_subcategories as $product_subcategory)
                <option value="{{$product_subcategory->id}}">{{$product_subcategory->name}}</option>
                <br>
                @endforeach
            </select>

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
<script>


//   $.ajax({
//     type: "get", //HTTP通信の種類
//     url:'/product/index', //通信したいURL
//     dataType: 'json'
//   })

//   //通信が成功したとき
//   .done((res)=>{
//  // 選択されたカテゴリのIDを取得
//     const id = product_category_id.options[num].value;
//   })

//   //通信が失敗したとき
//   .fail((error)=>{
//     console.log(error.statusText)
//   })


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
