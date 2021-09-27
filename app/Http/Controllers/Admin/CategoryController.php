<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProductCategory;
use App\ProductSubcategory;

use App\Http\Requests\StoreMemberForm;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Builder;



class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }





// 一覧表示と検索
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
                $search_split = mb_convert_kana($search,'s');
                $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

                foreach($search_split2 as $value)
                {
                    $query->where('name','LIKE','%'.$value.'%');
                    // ここ！
                    $query->orWhereHas('productSubcategories', function($query) use ($value) {
                        $query->where('name','like','%'.$value.'%');
                    });
                }
            };
        }
        $categories = $query->sortable()->orderBy('id', 'desc')->paginate(10);
        // dd($categories);

        $back_url = null;
        $now_route = url()->full();
        session(['now_route' => $now_route]);
        $back_url = session('now_route');

        return view('admin.category-archive',compact('categories'));
    }





// フォーム出力
    public function categoryEditShowForm(Request $request, $id){

        $category = ProductCategory::find($id);
        $subcategory = ProductSubcategory::where('product_category_id',$id)->select(['id', 'name'])->get();
        $back_url = $request->session()->get("now_route");

        return view('admin.category-register-edit',compact('category','subcategory','back_url','id'));
    }

    // public function categoryRegisterShowForm(Request $request){
    //     $back_url = $request->session()->get("now_route");
    //     $category_info = null;
    //     return view('admin.category-register-edit',compact('back_url','category_info'));
    // }




// バリデーション
    public function categoryEditConfirm(Request $request){
        $validator = $request->validate([
            'name' =>'required|max:20|string',
            'sub_name0' =>'required|max:20|string',
            'sub_name1' =>'nullable|max:20|string',
            'sub_name2' =>'nullable|max:20|string',
            'sub_name3' =>'nullable|max:20|string',
            'sub_name4' =>'nullable|max:20|string',
            'sub_name5' =>'nullable|max:20|string',
            'sub_name6' =>'nullable|max:20|string',
            'sub_name7' =>'nullable|max:20|string',
            'sub_name8' =>'nullable|max:20|string',
            'sub_name9' =>'nullable|max:20|string',
        ]);
            // 取り出し
            $id = $request->id;
            $name = $request->name;
            $sub_name0 = $request->sub_name0;
            $sub_name1 = $request->sub_name1;
            $sub_name2 = $request->sub_name2;
            $sub_name3 = $request->sub_name3;
            $sub_name4 = $request->sub_name4;
            $sub_name5 = $request->sub_name5;
            $sub_name6 = $request->sub_name6;
            $sub_name7 = $request->sub_name7;
            $sub_name8 = $request->sub_name8;
            $sub_name9 = $request->sub_name9;


            // 確認画面に表示する値を格納
            $input = [
                'id' => $id,
                'name' => $name,
                'sub_name0' => $sub_name0,
                'sub_name1' => $sub_name1,
                'sub_name2' => $sub_name2,
                'sub_name3' => $sub_name3,
                'sub_name4' => $sub_name4,
                'sub_name5' => $sub_name5,
                'sub_name6' => $sub_name6,
                'sub_name7' => $sub_name7,
                'sub_name8' => $sub_name8,
                'sub_name9' => $sub_name9,
            ];

        return view('admin.category-register-edit-confirm', compact('input') );
    }

    //     public function memberRegisterConfirm(StoreMemberForm $request){
//         $nickname = $request->nickname;
//         $input = [
//             'nickname' => $nickname,
//         ];
//     return view('admin.member-register-edit-confirm', compact('input') );
// }


    public function categoryEditComplete(Request $request){
        // dd($request);
        $id = $request->id;

        if ($request->get('back')) {
            return redirect()->route('admin.category-edit', ['id' => $id])
            ->withInput();
        }


        // 商品大カテゴリのnameを更新
        $new_category = ProductCategory::find($id);
        $new_category->name = $request->name;
        $new_category->save();


        $subcategory = ProductSubcategory::where('product_category_id',$id);
        $subcategory->delete();

        $new_subcategory0 = new ProductSubcategory;
        $new_subcategory0->product_category_id = $id;
        $new_subcategory0->name = $request->sub_name0;
        $new_subcategory0->save();

        if(isset($request->sub_name1)){
            $new_subcategory1 = new ProductSubcategory;
            $new_subcategory1->product_category_id = $id;
            $new_subcategory1->name = $request->sub_name1;
            $new_subcategory1->save();
        }
        if(isset($request->sub_name2)){
            $new_subcategory2 = new ProductSubcategory;
            $new_subcategory2->product_category_id = $id;
            $new_subcategory2->name = $request->sub_name2;
            $new_subcategory2->save();
        }
        if(isset($request->sub_name3)){
            $new_subcategory3 = new ProductSubcategory;
            $new_subcategory3->product_category_id = $id;
            $new_subcategory3->name = $request->sub_name3;
            $new_subcategory3->save();
        }
        if(isset($request->sub_name4)){
            $new_subcategory4 = new ProductSubcategory;
            $new_subcategory4->product_category_id = $id;
            $new_subcategory4->name = $request->sub_name4;
            $new_subcategory4->save();
        }
        if(isset($request->sub_name5)){
            $new_subcategory5 = new ProductSubcategory;
            $new_subcategory5->product_category_id = $id;
            $new_subcategory5->name = $request->sub_name5;
            $new_subcategory5->save();
        }
        if(isset($request->sub_name6)){
            $new_subcategory6 = new ProductSubcategory;
            $new_subcategory6->product_category_id = $id;
            $new_subcategory6->name = $request->sub_name6;
            $new_subcategory6->save();
        }
        if(isset($request->sub_name7)){
            $new_subcategory7 = new ProductSubcategory;
            $new_subcategory7->product_category_id = $id;
            $new_subcategory7->name = $request->sub_name7;
            $new_subcategory7->save();
        }
        if(isset($request->sub_name8)){
            $new_subcategory8 = new ProductSubcategory;
            $new_subcategory8->product_category_id = $id;
            $new_subcategory8->name = $request->sub_name8;
            $new_subcategory8->save();
        }
        if(isset($request->sub_name9)){
            $new_subcategory9 = new ProductSubcategory;
            $new_subcategory9->product_category_id = $id;
            $new_subcategory9->name = $request->sub_name9;
            $new_subcategory9->save();
        }

        return redirect()->route('admin.home');
    }



    // 詳細ページ
    public function categoryShow(Request $request,$id){
        $category = ProductCategory::find($id);
        $sub_categories = ProductSubcategory::where('product_category_id',$id)->select(['id','name'])->get();

        $back_url = $request->session()->get("now_route");
        return view('admin.category-show', compact('category','sub_categories','back_url') );
    }

    public function categoryDelete($id){
        ProductCategory::find($id)->delete();
        return redirect()->route('admin.category');
    }

}
