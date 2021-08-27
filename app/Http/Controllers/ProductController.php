<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use InterventionImage;
use Illuminate\Support\Facades\Auth;
use App\Member;
use App\Models\UploadImage;



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
        $input = $request->except('image_1');
        $image_1 = $request->file('image_1');

        if($request->hasFile('image_1')){
            $path = \Storage::put('/public', $image_1);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        $name = $input['name'];
        $product_category_id = $input['product_category_id'];
        $product_subcategory_id = $input['product_subcategory_id'];
        $product_content = $input['product_content'];

        $data = array(
            'path' => $path,
            'name' => $name,
            'product_category_id' => $product_category_id,
            'product_subcategory_id' => $product_subcategory_id,
            'product_content' => $product_content,
        );

        $category =  DB::table('product_categories')
        ->where('id',$product_category_id)->value('name');

        $sub_category = DB::table('product_subcategories')
        ->where('id',$product_subcategory_id)->value('name');

        // dd($data);

        $request->session()->put('data', $data);
        return view('products.confirm', compact('data','category','sub_category') );
    }


    // DBへあたい登録
    public function store(Request $request)
        {
            //セッションから値を取り出す
            $data = $request->session()->get("data");

            //セッションに値が無い時はフォームに戻る
            if(!$data){
                return redirect()->action("ProductController@index");
            }
            // 戻るボタン
            if($request->has("back")){
                return redirect()->action("ProductController@index")
                ->withInput($data);
            }

                // データベースへ登録
                $post = new Product;

                // 現在認証しているユーザーのIDを代入
                $post->member_id =  auth()->id();
                $post->name = $data['name'];
                $post->product_category_id = $data['product_category_id'];
                $post->product_subcategory_id = $data['product_subcategory_id'];
                $post->product_content = $data['product_content'];
                $post->image_1 = $data['path'][1];

                $post->save();

                $request->session()->forget("form_input");


        // 会員トップへ戻る
        return redirect()->action("HomeController@index");

            }
}
