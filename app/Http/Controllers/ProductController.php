<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Member;
use App\ProductCategory;
use App\ProductSubcategory;


class ProductController extends Controller
{
    public function index(){
        // 主⇨従。メンバーIDが2の人が登録した商品
        // $product =  Member::find(2)->products;
        // dd($product);

        // カテゴリー２（家電）の製品を取得
        // $product =  ProductCategory::find(2)->products;
        // dd($product);
           // カテゴリー２（家電）に属するサブカテゴリー群を取得
        $product =  ProductCategory::find(5)->productSubcategory;
        dd($product);


    }
}
