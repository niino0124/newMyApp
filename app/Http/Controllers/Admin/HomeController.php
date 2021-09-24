<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Http\Requests\StoreMemberForm;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function showMemberArchive(Request $request)
    {
        // dump($request);
        $id = $request->input('id');
        $gender = $request->input('gender');
        $search = $request->input('search');

        $query = Member::query();


        // $query = Member::query();
        // $query->get();

        if($id == null && $gender == null && $search == null){
            dump('全件表示');
                // $query->get();
        }else{
            dump('検索表示');
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

        $members = $query->sortable()->orderBy('id', 'desc')->paginate(10);

        return view('admin.member-archive',compact('members'));
    }

    public function memberEditShowForm($id){
        $member_info = Member::where('id',$id)->get();
        // dd($member);
        return view('admin.member-edit',compact('member_info'));
    }



    public function memberEditConfirm(Request $request){
        // バリデーション
        $validator = $request->validate([
            'name_sei' =>'max:19|string',
            'name_mei' =>'max:19|string',
            'nickname' =>'max:9|string',
            "gender" => "integer|in:1,2",
            "password" => ['nullable','string', new Hankaku, 'min:8','max:20','confirmed'],
            "password_confirmation" => ['nullable','string', new Hankaku, 'min:8','max:20'],
            "email" => [
                'string',
                'max:199',
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

        return view('admin.member-edit-confirm', compact('input') );
    }

    public function memberEditComplete(Request $request){
        // dd($request);
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



    public function memberRegisterShowForm(){
        return view('admin.member-register');
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
                'name_sei' => $name_sei,
                'name_mei' => $name_mei,
                'gender' => $gender,
                'nickname' => $nickname,
                'email' => $email,
                'password' => $password,
                'gender' => $gender,
            ];

        return view('admin.member-edit-confirm', compact('input') );
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
}
