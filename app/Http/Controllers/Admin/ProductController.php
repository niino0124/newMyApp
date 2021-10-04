<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Review;
use App\ProductCategory;
use App\ProductSubcategory;

use Illuminate\Support\Facades\DB;


use App\Http\Requests\StoreProductForm;




class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showProductArchive(Request $request){
        $id = $request->input('id');
        $search = $request->input('search');
        $query = Product::query();

        if($id == null && $search == null){
            dump('全件表示');
        }else{
            dump('検索表示');
            if($id != 0){
                $query->where('id',$id);
            };

            if($search != null){
                $search_split = mb_convert_kana($search,'s');
                $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

                foreach($search_split2 as $value)
                {
                    $query->where('name','LIKE','%'.$value.'%');
                    $query->orWhere('product_content','LIKE','%'.$value.'%');
                }
            };
        }
        // dump($query->toSql());
        dump($query->toSql(), $query->getBindings());
        $products = $query->sortable()->orderBy('id', 'desc')->paginate(10);
        $back_url = null;
        $now_route = url()->full();
        session(['now_route' => $now_route]);
        $back_url = session('now_route');

        return view('admin.product-archive',compact('products'));
    }

    // このメソッドをAjaxから実行したい
        public function ajax($id) {
            if($id == 0){
                $product_subcategories = '';
            }
            if($id != 0){
                $product_subcategories = ProductSubcategory::where('product_category_id',$id)->get();
            }
        return response()->json($product_subcategories);
    }

    // 登録フォーム表示
    public function productRegisterShowForm(Request $request){
        $product_categories = ProductCategory::all();
        $product_subcategories = ProductSubcategory::all();

        $back_url = $request->session()->get("now_route");

        // 確認画面から戻ってくる場合
        if (null !== old('product_category_id') ){
            $product_category_id = old('product_category_id');
            $old_product_subcategory_infos= DB::table('product_subcategories')
            ->where('product_category_id',$product_category_id)
            ->select('id','product_category_id','name')
            ->get();
            return view('admin.product-register-edit',compact('product_categories','product_subcategories','old_product_subcategory_infos','back_url'));
        }

        return view('admin.product-register-edit',compact('product_categories','product_subcategories','back_url'));
    }

    // 編集フォーム表示
    public function productEditShowForm(Request $request, $id){
        $product = Product::where('id',$id)->with(['productCategory', 'productSubcategory','reviews'])->first();

        $product_id = $product->product_category_id;

        $product_categories = ProductCategory::all();
        $product_subcategories_edit = ProductSubcategory::where('product_category_id',$product_id)->select('id','name')->get();

        $back_url = $request->session()->get("now_route");

                // 確認画面から戻ってくる場合
                if (null !== old('product_category_id') ){
                    $product_category_id = old('product_category_id');
                    $old_product_subcategory_infos= DB::table('product_subcategories')
                    ->where('product_category_id',$product_category_id)
                    ->select('id','product_category_id','name')
                    ->get();
                    return view('admin.product-register-edit',compact('product_categories','old_product_subcategory_infos','back_url'));
                }
        return view('admin.product-register-edit',compact('product','product_categories','product_subcategories_edit','back_url'));
    }

    // 確認画面以降前のバリデーションなど(// 登録確認)
    public function productRegisterConfirm(StoreProductForm $request){
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
            'name' => $name,
            'product_category_id' => $product_category_id,
            'product_subcategory_id' => $product_subcategory_id,
            'path1' => $path1,
            'path2' => $path2,
            'path3' => $path3,
            'path4' => $path4,
            'product_content' => $product_content,
        );

        $category =  ProductCategory::find($product_category_id)->first();
        $sub_category =ProductSubcategory::find($product_subcategory_id)->first();
        $request->session()->put('data', $data);

        return view('admin.product-register-edit-confirm', compact('data','category','sub_category') );
    }

    // 編集確認
    public function productEditConfirm(StoreProductForm $request){
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
        }

        $id = $input['id'];
        $name = $input['name'];
        $product_category_id = $input['product_category_id'];
        $product_subcategory_id = $input['product_subcategory_id'];
        $product_content = $input['product_content'];


        $data = array(
            'id' => $id,
            'name' => $name,
            'product_category_id' => $product_category_id,
            'product_subcategory_id' => $product_subcategory_id,
            'path1' => $path1,
            'path2' => $path2,
            'path3' => $path3,
            'path4' => $path4,
            'product_content' => $product_content,
        );

        $category =  ProductCategory::where('id',$product_category_id)->first();
        $sub_category =ProductSubcategory::where('id',$product_subcategory_id)->first();
        $request->session()->put('data', $data);

        return view('admin.product-register-edit-confirm', compact('data','category','sub_category') );
    }

    // 登録完了
    public function productRegisterComplete(Request $request)
        {
            //セッションから値を取り出す
            $data = $request->session()->get("data");

            //セッションに値が無い時はフォームに戻る
            if(!$data){
            return redirect()->action("admin.product-register");
            }
            // 戻るボタン
            if($request->has("back")){
                return redirect()->route("admin.product-register")
                ->withInput($data);
            }

                // データベースへ登録
                $product = new Product;

                // 現在認証している管理者ユーザーのIDを代入???
                $product->member_id =  auth()->id();
                $product->name = $data['name'];
                $product->product_category_id = $data['product_category_id'];
                $product->product_subcategory_id = $data['product_subcategory_id'];
                $product->product_content = $data['product_content'];
                $product->image_1 = $data['path1'];
                $product->image_2 = $data['path2'];
                $product->image_3 = $data['path3'];
                $product->image_4 = $data['path4'];

                $product->save();

                $request->session()->forget("form_input");
                return redirect()->route("admin.products");
            }

    // 編集完了
    public function productEditComplete(Request $request)
        {
            //セッションから値を取り出す
            $data = $request->session()->get("data");
            $id = $data['id'];


            //セッションに値が無い時はフォームに戻る
            if(!$data){
            return redirect()->action("admin.product-edit");
            }
            // 戻るボタン
            if($request->has("back")){
                return redirect()->route('admin.product-edit', ['id' => $id])
                ->withInput($data);
            }

            // データベース更新
            $product = Product::find($id);

            // 現在認証している管理者ユーザーのIDを代入???
            $product->name = $data['name'];
            $product->product_category_id = $data['product_category_id'];
            $product->product_subcategory_id = $data['product_subcategory_id'];
            $product->product_content = $data['product_content'];
            $product->image_1 = $data['path1'];
            $product->image_2 = $data['path2'];
            $product->image_3 = $data['path3'];
            $product->image_4 = $data['path4'];
            $product->save();
            $request->session()->forget("form_input");
            // 商品一覧へ戻る
            return redirect()->route("admin.products");
            }




    // 詳細ページ
    public function productShow(Request $request,$id){
        $product = Product::where('id',$id)->with(['productCategory', 'productSubcategory','reviews'])->first();

        $reviews = Review::where('product_id',$product->id)
        ->with('member')
        ->paginate(3);

        $avg = $reviews->avg('evaluation');
        $avg = ceil($avg);



        $back_url = $request->session()->get("now_route");
        return view('admin.product-show', compact('product','avg','reviews','back_url'));
    }

    // 削除
    public function productDelete($id){
        Product::find($id)->delete();
        return redirect()->route('admin.products');
    }



}
