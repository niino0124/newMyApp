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

    private $formItems = ['name','product_category_id','product_subcategory_id','image_1','product_content'];

    private $validator = [
        'name' =>'required|max:100|string',
        "product_category_id" => "required|integer",
        "product_subcategory_id" => "required|integer",
        "image_1" => "image|mimes:jpeg,png,jpg,gif|max:10240",
        'product_content' =>'required|max:100|string',
	];


    // 登録画面表示
    public function index(){
        // カテゴリは全て選択可能
        $product_categories = ProductCategory::all();
        $product_subcategories = ProductSubCategory::all();

        // 確認画面から戻ってくる場合
        if (null !== old('product_category_id') ){
            $product_category_id = old('product_category_id');

            $old_product_subcategory_infos= DB::table('product_subcategories')
            ->where('product_category_id',$product_category_id)
            ->select('id','product_category_id','name')
            ->get();

            return view('products.register',compact('product_categories','product_subcategories','old_product_subcategory_infos'));
        }

        // if (null !== old('product_subcategory_id') ){
        //     $product_subcategory_id = old('product_subcategory_id');

        //     $old_product_subcategory_infos= DB::table('product_subcategories')
        //     ->where('id',$product_subcategory_id)
        //     ->select('id','product_category_id','name')
        //     ->get();

        //     return view('products.register',compact('product_categories','product_subcategories','old_product_subcategory_infos'));
        // }

        return view('products.register',compact('product_categories','product_subcategories'));
    }


    // このメソッドをAjaxから実行したい
    public function ajax($id) {
        // 何らかの処理
        $product_subcategories = DB::table('product_subcategories')
        ->where('product_category_id',$id)
        ->get();

        return response()->json($product_subcategories);

    }

    // 確認画面以降前のバリデーションなど
    public function create(Request $request){
        $input = $request->only($this->formItems);
        // バリデーション
        // $validator = Validator::make($input, $this->validator);

		// if($validator->fails()){
		// 	return redirect()->action("ProductController@index")
		// 		->withInput()
		// 		->withErrors($validator);
		// }


        $input = $request->only($this->formItems);

        //セッションに書き込む
        $request->session()->put("form_input", $input);

        return redirect()->action("ProductController@confirm");
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
        // return view("products.confirm",["input" => $input])
    }

            // 確認画面表示
            public function confirm(Request $request)
            {
                //セッションから値を取り出す
                $input = $request->session()->get("form_input");


                $category_id = $input["product_category_id"];
                $subcategory_id = $input["product_subcategory_id"];

                $category = DB::table('product_categories')
                ->where('id',$category_id)->value('name');

                $sub_category = DB::table('product_subcategories')
                ->where('id',$subcategory_id)->value('name');



                // $input["product_category_id"]

                //セッションに値が無い時はフォームに戻る
                if(!$input){
                    return redirect()->action("ProductController@index");
                }

                return view("products.confirm",compact('input','category','sub_category'));
            }

            // DBへあたい登録
            public function store(Request $request)
            {

                //セッションから値を取り出す
                $input = $request->session()->get("form_input");



                if($request->has("back")){
                    return redirect()->action("ProductController@index")
                    ->withInput($input);
                    }

                    //セッションに値が無い時はフォームに戻る
                    if(!$input){
                        return redirect()->action("SampleFormController@show");
                    }

                // 保存
                        // データベースへ登録
                    $post = new Product;

                    Auth::user()->id = $input['member_id'];

                    $post->product_category_id = $input['product_category_id'];
                    $post->product_subcategory_id = $input['product_subcategory_id'];
                    $post->name = $input['name'];
                    $post->image_1 = $input['image_1'];
                    $post->image_2 = $input['image_2'];
                    $post->image_3 = $input['image_3'];
                    $post->image_4 = $input['image_4'];
                    $post->product_content = $input['product_content'];

                    $post->save();

                //セッションを空にする
		$request->session()->forget("form_input");

                // 会員トップへ戻る
                return redirect()->action("HomeController@index");
            }
}
