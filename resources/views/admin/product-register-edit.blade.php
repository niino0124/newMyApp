@extends('layouts.app_admin')
@section('title', ' 商品登録・編集ページ')
@section('content')
<div class="blue-board_admin">
    <div class="header_b">
        <div class="simple-wrap_sb">
            <p class="fw-bold">
                @if (isset($product))
                商品編集 @else 商品登録 @endif</p>
            <div class="simple-wrap">
                <a class="btn-simple" href="{{ $back_url }}">
                    一覧へ戻る
                </a>
            </div>
        </div>
    </div>

    <div class="man-body_b ">
        {{-- ひょっとしたら、actionも一元化できるかも --}}
        <form method="post" action="@if (isset($product)){{route('admin.product-edit-confirm')}}@else{{route('admin.product-register-confirm')}}@endif">
            @csrf
            <div class="element_wrap_str">
                <label for="id">ID</label>
                <div class="content-wrap">
                    @if (isset($product)){{ $product->id }} <input value="{{ $product->id }}" name="id" hidden> @else 登録後に自動採番@endif
                </div>
            </div>
            <div class="element_wrap">
                <label>商品名</label>
                <div class="content-wrap">
                    <input id="name" type="text" class="@error('name') is-invalid @enderror long" name="name"
                        value="@if(isset($product) && is_null(old('name'))){{ $product->name }}@else {{old('name')}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="element_wrap ">
                <div class="content_wrap_v">
                    <label for="product_category" class="product_category"><label>商品カテゴリ</label>
                        <div class="btn-wrap">
                            <select name="product_category_id" id="product_category_id">
                                <option value="0">選択してください</option>
                                @foreach ($product_categories as $product_category)
                                <option value="{{$product_category->id}}" @if(isset($product) && $product->product_category_id == $product_category->id && is_null(old('product_category_id'))) selected @elseif(old('product_category_id')==$product_category->id) selected @endif >{{$product_category->name}}</option>
                                @endforeach
                            </select>

                            @error('product_category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="btn-wrap">

                            @if(isset($product) && is_null(old('product_subcategory_id')))
                            <select name="product_subcategory_id">
                                <option value="" class="op_aj" id="children">選択してください</option>

                                @foreach ($product_subcategory_infos as $product_subcategory_info)
                                <option value="{{ $product_subcategory_info->id }}" class="op_aj" id="children" @if(
                                    $product->product_subcategory_id == $product_subcategory_info->id)
                                    selected
                                    @endif>{{ $product_subcategory_info->name }}</option>
                                @endforeach
                                
                            </select>

                            @elseif(is_null($product))
                            <select name="product_subcategory_id" id="product_subcategory_id">
                                <option value="" class="op_aj" id="children">選択してください</option>
                                {{-- で、ここにappendchildでadd_opが来ると。登録の方の理論はわかった。別々ならわかりやすい。一元化しなければならないならもっと考える必要がある。(1125) --}}
                            </select>

                            @elseif(isset(old('product_subcategory_id')))
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

            <div class="element_wrap_v">
                <label for="product_category" class="product_category"><label for="name">商品写真</label>
                    <div class="pics_wrap">

                        <div class="view_box">
                            <label class="img_label">写真１

                                @if(isset($product->paht1) && null == old('path1'))
                                <div class="img_view"><img alt="" class="img" width="150" height="150"
                                        src="{{'/storage/' . $product->paht1}}"></div>
                                <input type="hidden" value={{old('path1')}} name="path1">@elseif(is_null($product->paht1) &&  old('path1')!= null )
                                @endif

                            </label>
                            <div class="originalFileBtn">
                                アップロード
                                <input class="file" name="image_1" type="file">
                            </div>

                            @error('image_1')
                            <span class="invalid-feedback " role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- jqueryで表示させるエラー --}}
                            <span class="invalid-feedback j_message" role="alert">

                            </span>
                        </div>

                        <div class="view_box">
                            <label class="img_label">写真２
                                @if(null != old('path2'))
                                <div class="img_view"><img alt="" class="img" width="150" height="150"
                                        src="{{'/storage/' . old('path2')}}"></div>
                                <input type="hidden" value={{old('path2')}} name="path2">
                                @endif
                            </label>
                            <div class="originalFileBtn">
                                アップロード
                                <input class="file" name="image_2" type="file">
                            </div>
                            @error('image_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- jqueryで表示させるエラー --}}
                            <span class="invalid-feedback j_message" role="alert">
                            </span>
                        </div>

                        <div class="view_box">
                            <label class="img_label">写真３
                                @if(null != old('path3'))
                                <div class="img_view"><img alt="" class="img" width="150" height="150"
                                        src="{{'/storage/' . old('path3')}}"></div>
                                <input type="hidden" value={{old('path3')}} name="path3">
                                @endif
                            </label>
                            <div class="originalFileBtn">
                                アップロード
                                <input class="file" name="image_3" type="file">
                            </div>
                            @error('image_3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- jqueryで表示させるエラー --}}
                            <span class="invalid-feedback j_message" role="alert">
                            </span>
                        </div>

                        <div class="view_box">
                            <label class="img_label">写真４
                                @if(is_null(old('path4') && isset($product->path4 )))<div class="img_view"><img alt="" class="img" width="150" height="150"
                                    src="{{'/storage/' . $product->path4}}"></div>
                            <input type="hidden" value={{$product->path4}} name="path4"> @elseif(isset(old('path4')))
                                <div class="img_view"><img alt="" class="img" width="150" height="150"
                                        src="{{'/storage/' . old('path4')}}"></div>
                                <input type="hidden" value={{old('path4')}} name="path4">
                                @endif
                            </label>
                            <div class="originalFileBtn">
                                アップロード
                                <input class="file" name="image_4" type="file">
                            </div>
                            {{-- このエラー文は必要？ --}}
                            @error('image_4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            {{-- jqueryで表示させるエラー --}}
                            <span class="invalid-feedback j_message" role="alert">
                            </span>
                        </div>
                    </div>
            </div>

            <div class="element_wrap">
                <label for="product_content">商品説明</label>
                <div class="content-wrap">
                    <textarea id="product_content" type="text" class=" @error('product_content') is-invalid @enderror"
                        name="product_content" style="height: 90px">@if((is_null(old('product_content')) && isset($product))){{$product->product_content}}@else
                        {{ old('product_content') }}@endif</textarea>

                    @error('product_content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="btn-wrap">
                <input class="btn-back_b" type="submit" value="確認画面へ" />
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- 画像読み込み --}}
<script>
    $(document).ready(function () {

        $(".file").on('change', function(){
            // もともと画像やエラーが入っていたら削除
            var img_view = $(this).parent().siblings('.img_label').find('.img_view');
            img_view.remove();

            // 選択したファイルの情報を取得
        var fileprop = $(this).prop('files')[0],
            find_img = $(this).parent().siblings('.img_view').find('img'),
            find_img_2 = $(this).parent().siblings('.img_label').find('img'),
            filereader = new FileReader(),
            img_label = $(this).parent().siblings('.img_label');

        var type = fileprop.type,
            size = fileprop.size;

            // バリデーションメッセージ
        var error1 = '<strong class="error1">ファイルの上限サイズ10MBを超えています</strong>',
            error2 = '<strong class="error2">.jpg、.gif、.png、.jpegのいずれかのファイルのみ許可されています</strong>';

            // バリデーション
            if (size > 10000000) {
                $(this).parent().siblings('.j_message').append(error1);
            // 作業打ち切り！
                return false;
            }else{
                $(this).parent().siblings('.j_message').find('.error1').remove();
            }

            //画像でない場合は処理終了
            if(type.indexOf("image") < 0){
            $(this).parent().siblings('.j_message').append(error2);
            return false;
            }else{
            $(this).parent().siblings('.j_message').find('.error2').remove();
            }


        var img = '<div class="img_view"><img alt="" class="img"  width="150" height="150"></div>';

        img_label.append(img);

        filereader.onload = function() {
            img_label.find('img').attr('src', filereader.result);
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

        // 大カテゴリ欄に変更があった時の処理
        $('#product_category_id').change(function() {

        // もし前に選択したサブカテゴリの選択肢群と、OLDのサブカテゴリ欄が残っていれば消すがあれば削除
        $('.add_op').remove();
        $('#product_subcategory_id_old').remove();


        //選択したカテゴリIDを取得
        let id = $('option:selected').val();

        // IDをもとに、サブカテゴリ欄を表示、選択肢群を追加
        $.ajax({

        type: 'GET',
        url:"admin/product/index/" + id ,
        dataType: 'json',

        }).done(function (data) {
            // もしも「選択してください」が選択されたら
            if(data == ''){
                console.log('nullです');
                return $('#product_subcategory_id').hide();
            }

            // 「選択してください」以外が選択されたら
            $('#product_subcategory_id').show();
                $.each(data, function (index, value) {
                let id = value.id;
                let name = value.name;
                $('#product_subcategory_id').append($('<option>').text(name).attr({value: id,class:'add_op'}));
                })

            }).fail(function () {
                console.log('どんまい！!');
            });
    });
    });
</script>

@endsection
{{-- jQuery --}}