<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
// use App\Product;
// use App\Member;
use App\ProductCategory;
use App\ProductSubcategory;



class ProductController extends Controller
{

    private $formItems = ['name','product_category_id','product_subcategory_id','image','product_content'];

    private $validator = [
        'name' =>'required|max:100|string',
        "product_category_id" => "required|integer",
        "product_subcategory_id" => "required|integer",
        "image" => "image|mimes:jpeg,png,jpg,gif|max:10240",
        'product_content' =>'required|max:100|string',
	];

    // public function index(){
        // 主⇨従。メンバーIDが2の人が登録した商品
        // $product =  Member::find(2)->products;
        // dd($product);

        // カテゴリー２（家電）の製品を取得
        // $product =  ProductCategory::find(2)->products;
        // dd($product);
           // カテゴリー２（家電）に属するサブカテゴリー群を取得
        // $product =  ProductCategory::find(5)->productSubcategory;
        // dd($product);
    // }

    public function showRegistrationForm(){
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        // dd($categories);
        // $categories = $categories->prepend('カテゴリー名', '');

        return view('products.product-register',compact('categories','subcategories'));

    }


    public function validation(Request $request){
        $input = $request->only($this->formItems);
        $validator = Validator::make($input, $this->validator);
		if($validator->fails()){
			return redirect()->action("ProductController@showRegistrationForm")
				->withInput()
				->withErrors($validator);
		}

        //セッションに書き込む
		$request->session()->put("form_input", $input);

		return redirect()->action("ProductController@confirm");

        $imageFile = $request->image; //一時保存
        if(!is_null($imageFile) && $imageFile->isValid() ){
            // Storage::putFile('public/products', $imageFile);
            $fileName = uniqid(rand().’_’);
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName. ‘.’ . $extension;
            $resizedImage = InterventionImage::make($imageFile)->resize(1080, 1080)->encode();

            Storage::put(‘public/images/’ . $fileNameToStore, $resizedImage );
        }
    }

            // 確認画面表示
            public function confirm(Request $request)
            {
            //セッションから値を取り出す
            $input = $request->session()->get("form_input");

            //セッションに値が無い時はフォームに戻る
            if(!$input){
                return redirect()->action("ProductController@showRegistrationForm");
            }
            return view("products.product-confirm",["input" => $input]);
            }
}
