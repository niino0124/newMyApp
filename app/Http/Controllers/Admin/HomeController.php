<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Product;
use App\Http\Requests\StoreMemberForm;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // ちょいテスト
        return view('admin.home');
    }

    // 会員一覧
    public function showMemberArchive(Request $request)
    {
        $id = $request->input('id');
        $gender1 = $request->input('gender1');
        $gender2 = $request->input('gender2');
        // $gender = $request->input('gender');
        $search = $request->input('search');

        $query = Member::query();

        if($id == null && $gender1 == null && $gender2 == null && $search == null){
            // dump('全件表示');
                // $query->get();
        }else{
            // dump('検索表示');
            if($id != 0){
                $query->where('id',$id);
            };

            if($gender1 == 1 && $gender2 != 2){
                // dump('男性だけ選択された');
                $query->where('gender',$gender1);
            }

            if($gender1 != 1 && $gender2 == 2){
                // dump('女性だけ選択された');
                $query->where('gender',$gender2);
            }

            if($search != null){
            //全角スペースを半角に
                $search_split = mb_convert_kana($search,'s');
            //空白で区切る
                $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
                foreach($search_split2 as $value)
                {
                $query->where('name_sei','LIKE','%'.$value.'%')
                ->orWhere('name_mei', 'LIKE','%'.$value.'%')
                ->orWhere('email', 'LIKE','%'.$value.'%');
                }
            };

            if($gender1 == 1 && $gender2 == 2){
                // dump('両性選択された');
                $query->where('gender',$gender1)
                ->orWhere('gender',$gender2);
            };

        }

        $members = $query->sortable()->orderBy('id', 'desc')->paginate(10);

        $back_url = null;
        $now_route = url()->full();
        session(['now_route' => $now_route]);
        $back_url = session('now_route');

        // dump($query->toSql(), $query->getBindings());

        return view('admin.member-archive',compact('members'));
    }

    public function memberEditShowForm(Request $request, $id){
        $member_info = Member::where('id',$id)->get();
        $back_url = $request->session()->get("now_route");
        return view('admin.member-register-edit',compact('member_info','back_url'));
    }

    public function memberEditConfirm(Request $request){
        // バリデーション
        $validator = $request->validate([
            'name_sei' =>'max:20|string',
            'name_mei' =>'max:20|string',
            'nickname' =>'max:10|string',
            "gender" => "integer|in:1,2",
            "password" => ['nullable','string', new Hankaku, 'min:8','max:20','confirmed'],
            "password_confirmation" => ['nullable','string', new Hankaku, 'min:8','max:20'],
            "email" => [
                'string',
                'max:200',
                'email',
                Rule::unique('members')->ignore($request->id),
                ],
        ]);

            // 取り出し
            $name_sei = $request->name_sei;
            $name_mei = $request->name_mei;
            $gender = $request->gender;
            $nickname = $request->nickname;
            $email = $request->email;
            $password = $request->password;
            $gender = $request->gender;
            $id = $request->id;


            // 確認画面に表示する値を格納
            $input = [
                'name_sei' => $name_sei,
                'name_mei' => $name_mei,
                'gender' => $gender,
                'nickname' => $nickname,
                'email' => $email,
                'password' => $password,
                'gender' => $gender,
                'id' => $id
            ];

        return view('admin.member-register-edit-confirm', compact('input') );
    }

    public function memberEditComplete(Request $request){
        $id = $request->id;

        if ($request->get('back')) {
            return redirect()->route('admin.member-edit', ['id' => $id])
            ->withInput();
        }

        $member = Member::where('id',$id)->first();
        $member->name_sei = $request->name_sei;
        $member->name_mei = $request->name_mei;
        $member->nickname = $request->nickname;
        $member->gender = $request->gender;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();
        return redirect()->route('admin.home');
    }



    public function memberRegisterShowForm(Request $request){
        $back_url = $request->session()->get("now_route");
        $member_info = null;
        return view('admin.member-register-edit',compact('back_url','member_info'));
    }


    public function memberRegisterConfirm(StoreMemberForm $request){

            // 取り出し
            $name_sei = $request->name_sei;
            $name_mei = $request->name_mei;
            $gender = $request->gender;
            $nickname = $request->nickname;
            $email = $request->email;
            $password = $request->password;
            $gender = $request->gender;


            // 確認画面に表示する値を格納
            $input = [
                'id' => null,
                'name_sei' => $name_sei,
                'name_mei' => $name_mei,
                'gender' => $gender,
                'nickname' => $nickname,
                'email' => $email,
                'password' => $password,
                'gender' => $gender,
            ];

        return view('admin.member-register-edit-confirm', compact('input') );
    }

    public function memberRegisterComplete(Request $request){


        if ($request->get('back')) {
            return redirect()->route('admin.member-register')
            ->withInput();
        }

        $member = new Member;
        $member->name_sei = $request->name_sei;
        $member->name_mei = $request->name_mei;
        $member->nickname = $request->nickname;
        $member->gender = $request->gender;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();
        return redirect()->route('admin.home');
    }

    public function memberShow(Request $request,$id){
        $member_info = Member::where('id',$id)->get();

        $back_url = $request->session()->get("now_route");

        return view('admin.member-show', compact('member_info','back_url') );
    }

    public function memberDelete($id){
        Member::find($id)->delete();
        return redirect()->route('admin.members');
    }



// 商品一覧
    public function showProductArchive(Request $request){
        $id = $request->input('id');
        $gender = $request->input('gender');
        $search = $request->input('search');

        $query = Product::query();

        if($id == null && $gender == null && $search == null){
            // dump('全件表示');
                // $query->get();
        }else{
            // dump('検索表示');
            if($id != 0){
                $query->where('id',$id);
            };

            if($gender != 0){
                $query->where('gender',$gender);
            };

            if($search != null){
            //全角スペースを半角に
                $search_split = mb_convert_kana($search,'s');
            //空白で区切る
                $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
                foreach($search_split2 as $value)
                {
                $query->where('name_sei','LIKE','%'.$value.'%')
                ->orWhere('name_mei', 'LIKE','%'.$value.'%')
                ->orWhere('email', 'LIKE','%'.$value.'%');
                }
            };
        }

        $products = $query->sortable()->orderBy('id', 'desc')->paginate(10);

        $back_url = null;
        $now_route = url()->full();
        session(['now_route' => $now_route]);
        $back_url = session('now_route');

        return view('admin.product-archive',compact('products'));
    }


}
