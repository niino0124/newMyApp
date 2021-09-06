<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\ProductCategory;
use App\ProductSubcategory;
use App\Http\Requests\StoreProductForm;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use InterventionImage;
use Illuminate\Support\Facades\Auth;
use App\Member;
use App\Models\UploadImage;



class ProductController extends Controller
{
    // 登録画面表示
    public function index(){
        // カテゴリは全て選択可能
        $product_categories = ProductCategory::all();
        $product_subcategories = ProductSubcategory::all();

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
         // カテゴリが選択されていなければ、全サブカテゴリを表示
         if($id == 0){
            $product_subcategories = '';
        }

        // 何らかのカテゴリが選択されてれば、特定のサブカテゴリを表示
        if($id != 0){
            $product_subcategories = DB::table('product_subcategories')
            ->where('product_category_id',$id)
            ->get();
        }



        return response()->json($product_subcategories);
    }


    // 確認画面以降前のバリデーションなど
    public function create(StoreProductForm $request){
        $input = $request->except('image_1','image_2');
        $image_1 = $request->image_1;
        $image_2 = $request->image_2;





    if(is_null($image_1)){
        // NULLなら
        $path1 = NULL;
        'Nullです';

    }elseif(is_object($image_1)){
        echo '第一';
        // まだオブジェクトだったら
            $path1 = \Storage::put('/public', $image_1);
            $path1 = explode('/', $path1);
            $path1 = $path1[1];
            dump($path1);
        }else{
            echo '第三';
            // $image_1が既にパスとして出来上がっている場合はそのままpathに代入
            $path1 = $image_1;
            dump($path1);
        }






    if(is_null($image_2)){
        $path2 = NULL;
        'Nullです';
    }elseif(is_object($image_2)){
        echo '第一';
        // まだオブジェクトだったら
            $path2 = \Storage::put('/public', $image_2);
            $path2 = explode('/', $path2);
            $path2 = $path2[1];
            dump($path2);
        }else{
            echo '第三';
            // $image_2が既にパスとして出来上がっている場合はそのままpathに代入
            $path2 = $image_2;
            dump($path2);
        }


        $name = $input['name'];
        $product_category_id = $input['product_category_id'];
        $product_subcategory_id = $input['product_subcategory_id'];
        $product_content = $input['product_content'];

        $data = array(
            'path1' => $path1,
            'path2' => $path2,
            // 'path3' => $path3,
            // 'path4' => $path4,
            'name' => $name,
            'product_category_id' => $product_category_id,
            'product_subcategory_id' => $product_subcategory_id,
            'product_content' => $product_content,
        );


        $category =  DB::table('product_categories')
        ->where('id',$product_category_id)->value('name');

        $sub_category = DB::table('product_subcategories')
        ->where('id',$product_subcategory_id)->value('name');


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
                $post->image_1 = $data['path1'];
                $post->image_2 = $data['path2'];
                // $post->image_3 = $data['path3'][1];
                // $post->image_4 = $data['path4'][1];

                $post->save();

                $request->session()->forget("form_input");


                // 会員トップへ戻る
                return redirect()->action("HomeController@index");

            }



            // 一覧表示
            public function list(Request $request){

                $search = $request->input('search');
                $product_category_id = $request->input('product_category_id');
                $product_subcategory_id = $request->input('product_subcategory_id');

                 // 検索フォーム
                $query = Product::query();
                 // カテゴリnameを別のテーブルから持ってくるため
                $query->with('productCategory');
                $query->with('productSubcategory');

                 // どのカラムか
                $query->select( 'name', 'product_category_id', 'product_subcategory_id','image_1');


                if($search == null && $product_category_id == null && $product_subcategory_id == null){
                    dump('全件表示');
                    $query->get();

                }else{
                    dump('検索表示');
                    // もしカテゴリが選択されていたらAND
                    if($product_category_id !== '0'){
                        $query->where('product_category_id',$product_category_id);
                    };


                    if($product_subcategory_id !== '0'){
                        $query->where('product_subcategory_id',$product_subcategory_id);
                    };

                    // もしキーワードがあったら
                    if($search !== null){
                    //全角スペースを半角に
                        $search_split = mb_convert_kana($search,'s');

                    //空白で区切る
                        $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

                    //単語をループで回す
                        foreach($search_split2 as $value)
                        {
                        $query->where('name','LIKE','%'.$value.'%')
                        ->orWhere('product_content', 'LIKE','%'.$value.'%');
                        }
                    };
                }

                $query->orderBy('created_at', 'desc');
                $products = $query->paginate(10);


                // カテゴリ検索のためにある
                $product_categories = ProductCategory::all();
                $product_subcategories = ProductSubcategory::all();

                return view('products.list',compact('product_categories','product_subcategories','products'));
            }


            public function listAjax($id) {
                // カテゴリが選択されていなければ、全サブカテゴリを表示
                if($id == 0){
                    $product_subcategories = DB::table('product_subcategories')
                    ->get();
                }

                // 何らかのカテゴリが選択されてれば、特定のサブカテゴリを表示
                if($id != 0){
                    $product_subcategories = DB::table('product_subcategories')
                    ->where('product_category_id',$id)
                    ->get();
                }

                return response()->json($product_subcategories);
            }

}
