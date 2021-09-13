<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Member;
use App\Rules\Hankaku;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    private $formItems = ['name_sei','name_mei','nickname','gender'];

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_sei' =>'required|max:20|string',
            'name_mei' =>'required|max:20|string',
            'nickname' =>'required|max:10|string',
            "gender" => "required|integer|in:1,2",
        ]);
    }

    protected function validatorPass(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', new Hankaku, 'min:8','max:20','confirmed'],
            "password_confirmation" => ['required', 'string', new Hankaku, 'min:8','max:20'],
        ]);
    }

    protected function validatorEmail(array $data)
    {
        return Validator::make($data, [
            "email" => "required|unique:members|string|max:200|email",
        ]);
    }

    // protected function validatorAuth(array $data)
    // {
    //     return Validator::make($data, [
    //         "auth_code" => "required|unique:members|integer",
    //     ]);
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show()
    {
        return view('mypage');
    }

    public function leaveConfirm()
    {
        return view('leave-confirm');
    }

    public function delete()
    {
        $member = Auth::user();
        $member->delete();

        return redirect()->route('welcome');
    }

// 編集
    public function editProfile()
    {
        return view('edit-profile');
    }

    public function editProfilePost(Request $request)
    {
        // バリデーション
        $this->validator($request->all())->validate();
        $input = $request->only($this->formItems);

        // 表示
        return view('edit-profile-confirm',compact('input'));
    }

    public function editProfileStore(Request $request)
    {
        // dd($request);
        $id = Auth::id();
        $name_sei = $request->name_sei;
        $name_mei = $request->name_mei;
        $nickname = $request->nickname;
        $gender = $request->gender;

        // dd($id,$name_sei,$name_mei,$nickname,$gender);



        if ($request->get('back')) {
            return redirect()->route('home.edit-profile')
            ->withInput();
        }

        $member = Member::find($id);

        $member->name_sei = $name_sei;
        $member->name_mei = $name_mei;
        $member->nickname = $nickname;
        $member->gender = $gender;

        $member->save();

        return redirect()->route('home.show');
        }

        // パスワードリセット
        public function editPassword()
        {
            return view('edit-password');
        }

        public function editPasswordStore(Request $request)
        {
            // バリデーション
            $this->validatorPass($request->all())->validate();
            $input = $request->password;
            $input = Hash::make($input);
            // dd($input);


            $id = Auth::id();
            $member = Member::find($id);
            $member->password = $input;
            $member->save();

            return redirect()->route('home.show');
        }







            // メールアドレスリセット
        public function  editEmail()
        {
            return view('edit-email');
        }

        public function  editEmailSend(Request $request)
        {
            // バリデーション
            $this->validatorEmail($request->all())->validate();
            $email = $request->email;

            // ６桁の乱数を生成
            $str="";
            for($i=0;$i<6;$i++){
                $str.=mt_rand(0,9);
            }
            // 会員のauth_codeカラムに登録
            $id = Auth::id();
            $member = Member::find($id);
            $member->auth_code = $str;
            $member->save();

            // auth_codeを入力されたメールアドレスに送信。

            // 認証コード入力フォームを表示
            // return redirect()->route('home.edit-email-complete');
            return view('edit-email-confirm',compact('email'));

        }


        public function  editEmailComplete(Request $request)
        {
            $email = $request->email;
            $input_auth_code = $request->auth_code;


            $id = Auth::id();
            $member = Member::find($id);
            $auth_code = $member->auth_code;



            if($input_auth_code == $auth_code){
                // 新しいメールアドレスに更新
                $member->email = $email;
                $member->save();
            }


            return redirect()->route('home.show');
        }

}
