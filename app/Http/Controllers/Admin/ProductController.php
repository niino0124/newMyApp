<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\ProductCategory;
use App\ProductSubcategory;

use App\Http\Requests\StoreProductForm;

use App\Rules\Hankaku;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Builder;



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
            // カテゴリが選択されていなければ、全サブカテゴリを表示
            if($id == 0){
                $product_subcategories = '';
            }

           // 何らかのカテゴリが選択されてれば、特定のサブカテゴリを表示
            if($id != 0){
                $product_subcategories = ProductSubcategory::where('product_category_id',$id)->get();
            }

        return response()->json($product_subcategories);
    }

    public function productRegisterShowForm(Request $request){
        $product_categories = ProductCategory::all();
        // $product_subcategories = ProductSubcategory::all();



        $back_url = $request->session()->get("now_route");
        return view('admin.product-register-edit',compact('product_categories','back_url'));
    }

    // public function productEditShowForm(){
    //     $product_categories = ProductCategory::all();
    //     $product_subcategories = ProductSubcategory::all();


    //     return view('admin.product-register-edit',compact('product_categories'));
    // }

    // 確認画面以降前のバリデーションなど
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
            'path1' => $path1,
            'path2' => $path2,
            'path3' => $path3,
            'path4' => $path4,
            'name' => $name,
            'product_category_id' => $product_category_id,
            'product_subcategory_id' => $product_subcategory_id,
            'product_content' => $product_content,
        );


        // $category =  DB::table('product_categories')
        // ->where('id',$product_category_id)->value('name');
        $category =  ProductCategory::find($product_category_id)->select('name')->get();

        // $sub_category = DB::table('product_subcategories')
        // ->where('id',$product_subcategory_id)->value('name');
        $sub_category =ProductSubcategory::find($product_subcategory_id)->select('name')->get();

        $request->session()->put('data', $data);

        return view('admin.product-register-edit-confirm', compact('data','category','sub_category') );
    }


}
