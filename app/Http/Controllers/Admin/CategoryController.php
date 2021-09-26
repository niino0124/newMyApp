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
        // dd($subcategory);
        // $category_info = ProductCategory::where('id',$id)->get();
        // $subcategory_info = ProductSubcategory::where('product_category_id',$id)->select(['id', 'name'])->get();

        // 該当したサブカテゴリ数
        // $total_subcategory =count($subcategory_info);
        // 追加で必要な inputタグの数
        // $input_needed = 10 - $total_subcategory;


                    // $sub_name0 = $subcategory_info[0]->name;
                    // $sub_name1 = $subcategory_info[1]->name;
                    // $sub_name2 = $subcategory_info[2]->name;
                    // $sub_name3 = $subcategory_info[3]->name;
                    // $sub_name4 = $subcategory_info[4]->name;
                    // $sub_name5 = $subcategory_info[5]->name;
                    // $sub_name6 = $subcategory_info[6]->name;
                    // $sub_name7 = $subcategory_info[7]->name;
                    // $sub_name8 = $subcategory_info[8]->name;
                    // $sub_name9 = $subcategory_info[9]->name;
                    // $sub_name10 = $subcategory_info[10]->name;




                    // 確認画面に表示する値を格納
                    // $input = [
                    //     'id' => null,
                    //     'name_sei' => $name_sei,
                    //     'name_mei' => $name_mei,
                    //     'gender' => $gender,
                    //     'nickname' => $nickname,
                    //     'email' => $email,
                    //     'password' => $password,
                    //     'gender' => $gender,
                    // ];




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
            'sub_name10' =>'nullable|max:20|string',
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
            $sub_name10 = $request->sub_name10;


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
                'sub_name10' => $sub_name10,
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

        if ($request->get('back')) {
            return redirect()->route('admin.category-edit')
            ->withInput();
        }

        $new_category = new ProductCategory;
        $new_category->name = $request->name;
        $new_category->save();


        $new_subcategory = new ProductSubcategory;
        $new_subcategory->product_category_id = $request->id;
        $new_subcategory->name_mei = $request->name_mei;
        $new_subcategory->nickname = $request->nickname;
        $new_subcategory->gender = $request->gender;
        $new_subcategory->email = $request->email;
        $new_subcategory->password = bcrypt($request->password);
        $new_subcategory->save();
        return redirect()->route('admin.home');
    }


}
