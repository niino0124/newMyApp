<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\ProductCategory;
use App\ProductSubcategory;
use App\Review;
use App\Http\Requests\StoreProductForm;
use App\Http\Requests\StoreReviewForm;

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


        $prev_page_url = $_SERVER['HTTP_REFERER'];



        // dd($prev_page_url);
        if(strpos($prev_page_url,'list') !== false){
            $btn_back = '商品一覧へ戻る';
        }elseif(strpos($prev_page_url,'home') !== false){
            $btn_back = 'トップへ戻る';
        }else{
            $btn_back = '戻る';
        }


        // 確認画面から戻ってくる場合
        if (null !== old('product_category_id') ){
            $product_category_id = old('product_category_id');

            $old_product_subcategory_infos= DB::table('product_subcategories')
            ->where('product_category_id',$product_category_id)
            ->select('id','product_category_id','name')
            ->get();

            return view('products.register',compact('product_categories','product_subcategories','old_product_subcategory_infos'));
        }

            return view('products.register',compact('product_categories','product_subcategories','btn_back'));
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
        $input = $request->except('image_1','image_2','image_3','image_4');
        $image_1 = $request->image_1;
        $image_2 = $request->image_2;
        $image_3 = $request->image_3;
        $image_4 = $request->image_4;

        $path1 = $request->path1;
        $path2 = $request->path2;
        $path3 = $request->path3;
        $path4 = $request->path4;

        if(isset($path1) && is_null($image_1)){

        $path1 = $path1;
        'path1はoldとして戻ってきた';

        }elseif(is_null($image_1) && is_null($path1)){
        // NULLなら
        $path1 = NULL;
        'Nullです';

        }elseif(isset($image_1)){
        echo '第一';
        // まだオブジェクトだったら
            $path1 = \Storage::put('/public', $image_1);
            $path1 = explode('/', $path1);
            $path1 = $path1[1];
            // dump($path1);
        }

        // ２
        if(isset($path2) && is_null($image_2)){
            $path2 = $path2;
        }elseif(is_null($image_2) && is_null($path2)){
        $path2 = NULL;
        }elseif(isset($image_2)){
            $path2 = \Storage::put('/public', $image_2);
            $path2 = explode('/', $path2);
            $path2 = $path2[1];
            // dump($path2);
        }

        // ３
        if(isset($path3) && is_null($image_3)){
            $path3 = $path3;
        }elseif(is_null($image_3) && is_null($path3)){
        $path3 = NULL;
        }elseif(isset($image_3)){
            $path3 = \Storage::put('/public', $image_3);
            $path3 = explode('/', $path3);
            $path3 = $path3[1];
            // dump($path3);
        }

        // ４
        if(isset($path4) && is_null($image_4)){
            $path4 = $path4;
        }elseif(is_null($image_4) && is_null($path4)){
        $path4 = NULL;
        }elseif(isset($image_4)){
            $path4 = \Storage::put('/public', $image_4);
            $path4 = explode('/', $path4);
            $path4 = $path4[1];
            // dump($path4);
        }




        $name = $input['name'];
        $product_category_id = $input['product_category_id'];
        $product_subcategory_id = $input['product_subcategory_id'];
        $product_content = $input['product_content'];


        $data = array(
            'path1' => $path1,
            'path2' => $path2,
            'path3' => $path3,
            'path4' => $path4,
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
                $post->image_3 = $data['path3'];
                $post->image_4 = $data['path4'];


                $post->save();

                $request->session()->forget("form_input");

                // 商品一覧へ戻る
                return redirect()->action("ProductController@list");

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
                $query->select( 'name', 'product_category_id', 'product_subcategory_id','image_1','id');


                if($search == null && $product_category_id == null && $product_subcategory_id == null){
                    // dump('全件表示');
                    $query->get();

                }else{
                    // dump('検索表示');

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

                // dump($query->toSql(), $query->getBindings());
                // カテゴリ検索のためにある
                $product_categories = ProductCategory::all();
                $product_subcategories = ProductSubcategory::all();

                return view('products.list',compact('product_categories','product_subcategories','products'));
            }


            public function listAjax($id) {
                // カテゴリが選択されていなければ、全サブカテゴリを表示
                if($id == 0){
                    $product_subcategories = ProductSubcategory::get();
                }

                // 何らかのカテゴリが選択されてれば、特定のサブカテゴリを表示
                if($id != 0){
                    $product_subcategories = ProductSubcategory::where('product_category_id',$id)
                    ->get();
                }

                return response()->json($product_subcategories);
            }

            // 個別ページ
            public function show(Request $request,$id)
            {
                $product = Product::find($id);

                $evaluations = Review::where('product_id',$id)
                ->select('evaluation')
                ->get();

                $avg = $evaluations->avg('evaluation');
                $avg = ceil($avg);

                return view('products.show',compact('product','avg'));
            }

            // レビュー作成ページ
            public function review($id)
            {
                $product = Product::find($id);
                return view('products.review',compact('product'));
            }

            // 確認ボタンを押した時の処理
            public function reviewConfirm(StoreReviewForm $request)
            {
                $name = $request->name;
                $image_1 = $request->image_1;
                $image_2 = $request->image_2;
                $image_3 = $request->image_3;
                $image_4 = $request->image_4;
                $comment = $request->comment;
                $evaluation = $request->evaluation;
                $product_id = $request->product_id;
                

                // 確認画面に表示する値を格納
                $input_data = [
                    'name' => $name,
                    'image_1' => $image_1,
                    'image_2' => $image_2,
                    'image_3' => $image_3,
                    'image_4' => $image_4,
                    'comment' => $comment,
                    'evaluation' => $evaluation,
                    'product_id' => $product_id
                ];

                return view('products.review-confirm',compact('input_data'));
            }



            public function reviewStore(Request $request )
            {
                $id = $request->product_id;

                if ($request->get('back')) {
                    return redirect()->route('product.review', ['id' => $id])
                    ->withInput();
                }

                $post = new Review;

                // 現在認証しているユーザーのIDを代入
                $post->member_id =  auth()->id();
                $post->product_id = $id;
                $post->evaluation = $request['evaluation'];
                $post->comment = $request['comment'];

                $post->save();
                // 完了ページを表示
                return view('products.review-complete',compact('id'));
            }

            // 商品レビュー一覧
            public function reviewArchive($id)
            {
                $product = Product::find($id);

                $reviews = Review::where('product_id',$id)
                ->with('member')
                ->paginate(5);

                $avg = $reviews->avg('evaluation');
                $avg = ceil($avg);

                return view('products.review-archive',compact('product','avg','reviews'));
            }

}
