<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Member;

class ProductController extends Controller
{
    public function index(){
        // 主⇨従。メンバーIDが2の人が登録した商品
        $product =  Member::find(2)->products;
        dd($product);
    }
}
