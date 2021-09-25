<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\ProductCategory;
use App\Http\Requests\StoreMemberForm;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showCategoryArchive(Request $request){
        $id = $request->input('id');
        $search = $request->input('search');

        $query = ProductCategory::query();

        if($id == null && $search == null){
            dump('全件表示');
        }else{
            dump('検索表示');
            if($id != 0){
                $query->where('id',$id);
            };

            if($search != null){
            //全角スペースを半角に
                $search_split = mb_convert_kana($search,'s');
            //空白で区切る
                $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
                foreach($search_split2 as $value)
                {
                $query->where('name','LIKE','%'.$value.'%');
                // サブカテゴリのnameも追加
                }
            };
        }

        $categories = $query->sortable()->orderBy('id', 'desc')->paginate(10);

        $back_url = null;
        $now_route = url()->full();
        session(['now_route' => $now_route]);
        $back_url = session('now_route');

        return view('admin.category-archive',compact('categories'));
    }
}
