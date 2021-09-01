@extends('layouts.app')
@section('title', '商品登録')
@section('content')

<form method="post" action="{{route('product.create')}}" enctype="multipart/form-data" class="block-b">
    @csrf
    <h1>商品登録</h1>
    <div class="element_wrap">
        <label for="name">商品名</label>
        <div class="content-wrap">
            <input id="name" type="text" class=" @error('name') is-invalid @enderror long" name="name"
                value="{{ old('name') }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="element_wrap ">
        <div class="content_wrap_v">
            <label for="product_category" class="product_category"><label for="name">商品カテゴリ</label>
                <div style="display: flex;
            flex-direction: column">
                    <select name="product_category_id" id="product_category_id">

                        <option value="">選択してください</option>
                        @foreach ($product_categories as $product_category)
                        <option value="{{$product_category->id}}" @if(old('product_category_id')==$product_category->id)
                            selected @endif >{{$product_category->name}}</option>
                        @endforeach
                    </select>

                    @error('product_category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div style="display: flex;
            flex-direction: column">
                    <select name="product_subcategory_id" id="product_subcategory_id">
                        <option value="" class="op_aj" id="children">選択してください</option>
                    </select>
                    {{-- 確認画面から戻ってきた場合 --}}
                    @if (null !== old('product_subcategory_id') )
                    <select name="product_subcategory_id" id="product_subcategory_id_old">
                        <option value="" class="op_aj" id="children">選択してください</option>

                        @foreach ($old_product_subcategory_infos as $old_product_subcategory_info)

                        <option value="{{ $old_product_subcategory_info->id }}" class="op_aj" id="children" @if(
                            old('product_subcategory_id')==($old_product_subcategory_info->id))
                            selected
                            @endif >{{ $old_product_subcategory_info->name }}</option>

                        @endforeach

                    </select>
                    @endif

                    @error('product_subcategory_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

            </label>
        </div>
    </div>








    <div class="element_wrap">
        <label for="product_content">商品説明</label>
        <div class="content-wrap">
            <textarea id="product_content" type="text" class=" @error('product_content') is-invalid @enderror"
                name="product_content" style="height: 90px">{{ old('product_content') }}</textarea>

            @error('product_content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="element_wrap_v">
        <label for="product_category" class="product_category"><label for="name">商品写真</label>

        <div class="pics_wrap">
                <div class="view_box">
                    <label class="img_label">写真１
                    </label>
                    @if(null != old('path1'))
                    <div class="img_view"><img alt="" class="img" width="150" height="150"
                            src="{{'/storage/' . old('path1')}}"></div>
                    <input type="hidden" value={{old('path1')}} name="image_1">
                    @endif
                    <div class="originalFileBtn">
                        アップロード
                        <input class="file" name="image_1" type="file">
                    </div>
                </div>
                @error('image_1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="view_box">
                    <label class="img_label">写真２
                    </label>
                    @if(null != old('path2'))
                    <div class="img_view"><img alt="" class="img" width="150" height="150"
                            src="{{'/storage/' . old('path2')}}"></div>
                    <input type="hidden" value={{old('path2')}} name="image_2">
                    @endif
                    <div class="originalFileBtn">
                        アップロード
                        <input class="file" name="image_2" type="file">
                    </div>
                </div>
                @error('image_2')
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


{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- 画像読み込み --}}
<script>
    $(document).ready(function () {

        $(".file").on('change', function(){
        var fileprop = $(this).prop('files')[0],

            find_img = $(this).parent().siblings('.img_view').find('img'),
            find_img_2 = $(this).parent().siblings('.img_label').find('img'),

            filereader = new FileReader(),
            img_label = $(this).parent().siblings('.img_label');
            // img_view = $(this).parent().siblings('.img_view');


            // console.log(img_label);
            console.log(find_img);


        // 特定の要素が存在するかどうかを判別する処理【.length】
        if(find_img.length){
        find_img.nextAll().remove();
        find_img.remove();
        }

        // 特定の要素が存在するかどうかを判別する処理②【.length】
        if(find_img_2.length){
        find_img_2.nextAll().remove();
        find_img_2.remove();
        }

        var img = '<div class="img_view"><img alt="" class="img"  width="150" height="150"></div>';

        // view_box.prepend(img);
        // view_box.append(img);
        img_label.append(img);

        filereader.onload = function() {
            img_label.find('img').attr('src', filereader.result);
        // view_box.find('img').attr('src', filereader.result);
        // img_del(view_box);
        }
        filereader.readAsDataURL(fileprop);
    });

});
</script>




{{-- カテゴリ・サブカテゴリ --}}
<script>
    $(function() {
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
    });
    });
</script>

@endsection
