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
                        value="@if (isset($product)){{ $product->name }}@else {{old('name')}}">
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
                        <div class="btn-wrap">
                            <select name="product_category_id" id="product_category_id">
                                <option value="0">選択してください</option>
                                @foreach ($product_categories as $product_category)
                                <option value="{{$product_category->id}}" @if(isset($product) && $product->product_category_id == $product_category->id) selected @elseif(old('product_category_id')==$product_category->id)
                                    selected @endif >{{$product_category->name}}</option>
                                @endforeach
                            </select>

                            @error('product_category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="btn-wrap">
                            <select name="product_subcategory_id" id="product_subcategory_id">
                                <option value="" class="op_aj" id="children">選択してください</option>
                            </select>
                            {{-- 編集の場合。$old_product_subcategory_infoを書き直す必要があるかも --}}
                            @if (isset($product))
                            <select name="product_subcategory_id" id="product_subcategory_id_old">
                                <option value="" class="op_aj" id="children">選択してください</option>

                                @foreach ($old_product_subcategory_infos as $old_product_subcategory_info)

                                <option value="{{ $old_product_subcategory_info->id }}" class="op_aj" id="children" @if(
                                    $product->product_subcategory_id == ($old_product_subcategory_info->id))
                                    selected
                                    @endif>{{ $old_product_subcategory_info->name }}</option>
                                @endforeach
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

                                @if(null != old('path1'))
                                <div class="img_view"><img alt="" class="img" width="150" height="150"
                                        src="{{'/storage/' . old('path1')}}"></div>
                                <input type="hidden" value={{old('path1')}} name="path1">
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
                                @if(null != old('path4'))
                                <div class="img_view"><img alt="" class="img" width="150" height="150"
                                        src="{{'/storage/' . old('path4')}}"></div>
                                <input type="hidden" value={{old('path4')}} name="path4">
                                @endif
                            </label>
                            <div class="originalFileBtn">
                                アップロード
                                <input class="file" name="image_4" type="file">
                            </div>
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
                        name="product_content" style="height: 90px">@if ((isset($product))){{$product->product_content}}@else
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
@endsection
