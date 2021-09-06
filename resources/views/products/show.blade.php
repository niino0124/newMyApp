@extends('layouts.app')
@section('title', '商品詳細')
@section('content')

<div class="blue-board ">
    <div class="header">
        <div class="simple-wrap_sb">
            <p class="fw-bold">商品詳細</p>
            <div class="simple-wrap">
                @auth
                <a href="/home" class="btn btn-back-bl" >トップに戻る</a>
                @endauth
                @guest
                <a href="/" class="btn btn-back-bl" >トップに戻る</a>
                @endguest
            </div>
        </div>
    </div>
    <div class="man-body-tables">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">番号</th>
                <th scope="col">氏名</th>
                <th scope="col">タイトル</th>
                <th scope="col">メール</th>
                <th scope="col">url</th>

                <th scope="col">内容</th>
                <th scope="col">作成日時</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{$product->id}}
                </td>
                <td>{{$product->name}}</td>
                <td>                    {{$product->created_at}}
                </td>
                <td>{{$product->image_1}}</td>
                <td>{{$product->image_2}}</td>
                <td>{{$product->product_content}}</td>
                <td>{{$product->created_at}}</td>
            </tr>
            </tbody>
          </table>






        <div class="btn-wrap">
            <a href="{{url()->previous()}}" class="btn btn-back-bl" >商品一覧に戻る</a>
        </div>

    </div>
</div>


@endsection
