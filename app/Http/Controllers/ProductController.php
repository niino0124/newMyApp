<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
// use App\Product;
// use App\Member;
use Illuminate\Support\Facades\DB;
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


    // 登録画面表示
    public function index(){
        // カテゴリは全て選択可能
        $product_categories = ProductCategory::all();
        // $selected = 選択されたカテゴリのID

        // サブカテゴリをクエリビルダで検索
        // $query = DB::table('product_subcategories');
        // $query->where('id','=','?');

        $product_subcategories = ProductSubcategory::all();

        return view('products.register',compact('product_categories','product_subcategories'));
    }


    // このメソッドをAjaxから実行したい
    public function add($id) {
        // 何らかの処理
    }




    // 確認画面以降前のバリデーションなど
    public function create(Request $request){
        $input = $request->only($this->formItems);

        // バリデーション
        $validator = Validator::make($input, $this->validator);

		if($validator->fails()){
			return redirect()->action("ProductController@index")
				->withInput()
				->withErrors($validator);
		}

        //セッションに書き込む
		$request->session()->put("form_input", $input);

        // $imageFile = $request->image; //一時保存
        // if(!is_null($imageFile) && $imageFile->isValid() ){
        //     // Storage::putFile('public/products', $imageFile);
        //     $fileName = uniqid(rand().’_’);
        //     $extension = $imageFile->extension();
        //     $fileNameToStore = $fileName. ‘.’ . $extension;
        //     $resizedImage = InterventionImage::make($imageFile)->resize(1080, 1080)->encode();

        //     Storage::put(‘public/images/’ . $fileNameToStore, $resizedImage );
        // }

        // return redirect()->action('product.confirm');
        return redirect('product.confirm');
        // return view("products.confirm",["input" => $input])
    }

            // 確認画面表示
            public function confirm(Request $request)
            {
                //セッションから値を取り出す
                $input = $request->session()->get("form_input");
                dd($input);
                //セッションに値が無い時はフォームに戻る
                if(!$input){
                    return redirect()->action("ProductController@index");
                }

                return view("products.confirm",["input" => $input]);
            }

            // 確認画面表示
            public function store(Request $request)
            {
                //セッションから値を取り出す
                $input = $request->session()->get("form_input");

                // 保存

                // 会員トップへ戻る
                return redirect()->action("HomeController@index");
            }
}
