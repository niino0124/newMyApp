<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\ProductCategory;
use App\ProductSubcategory;

use App\Http\Requests\StoreMemberForm;
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


}
