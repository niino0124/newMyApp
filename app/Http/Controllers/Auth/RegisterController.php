<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// 追加
use Illuminate\Http\Request;
// メールを追加
use App\Mail\CompleteMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    // 追加
    private $form_show = 'Auth\RegisterController@showRegistrationForm';
    private $form_confirm = 'Auth\RegisterController@confirm';
    private $form_complete = 'Auth\RegisterController@complete';

    private $formItems = ['name_sei','name_mei','nickname','gender','password','password_confirmation','email'];
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        // ユーザー登録後、ログインをした状態にして、完了画面を表示するため、completeではguestミドルウェアを無効にする
        $this->middleware('guest',['except' => 'complete']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_sei' =>'required|max:20|string',
            'name_mei' =>'required|max:20|string',
            'nickname' =>'required|max:10|string',
            "gender" => "required|integer|in:1,2",
            "password" => "required|string|min:8|max:20|confirmed",
            "password_confirmation" => "required|string|min:8|max:20",
            "email" => "required|unique:members|string|max:200|email",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Member
     */
    protected function create(array $data)
    {
        return Member::create([
            'name_sei' => $data['name_sei'],
            'name_mei' => $data['name_mei'],
            'nickname' => $data['nickname'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }

    /*
     * 入力から確認へ遷移する際の処理
     */
    function post(Request $request)
    {
        $this->validator($request->all())->validate();

        $input = $request->only($this->formItems);

        //セッションに書き込む
        $request->session()->put("form_input", $input);

        return redirect()->action($this->form_confirm);
    }

    /**
     * 登録処理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        // 戻るボタン
        if ($request->has("back")) {
            return redirect()->action($this->form_show)
                ->withInput($input);
        }

        //セッションに値が無い時はフォームに戻る
        if (!$input) {
            return redirect()->action($this->form_show);
        }

        // new Registered($user = $this->create($request->all())) ;
        // event(new Registered($user = $this->create($request->all())) );
       //ここでメールを送信、DBへの登録するなどを行う
        Mail::to($input["email"])->send(new CompleteMail($input["name_sei"]));

        $member = new Member();
        $member->name_sei = $input["name_sei"];
        $member->name_mei = $input["name_mei"];
        $member->nickname = $input["nickname"];
        $member->gender = $input["gender"];
        $member->password = bcrypt($input["password"]);
        $member->email = $input["email"];

        $member->save();


        //セッションを空にする
        $request->session()->forget("form_input");

        // 登録データーでログイン
        $this->guard()->login($member, true);

        // return $this->registered($request, $member)
        //     ?  : redirect($this->redirectPath());
        return redirect()->action($this->form_complete);
    }

    /*
     * 登録完了後
     */
    // function registered(Request $request, $member)
    // {
    //     return redirect()->action($this->form_complete);
    // }

    /**
     * 会員登録入力フォーム出力
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('register.register');
    }

    /*
     * 確認画面出力
     */
    public function confirm(Request $request)
    {
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        //セッションに値が無い時はフォームに戻る
        if (!$input) {
            return redirect()->action("Auth\RegisterController");
        }

        return view('register.confirm', ["input" => $input]);
    }

    /*
     * 完了画面出力
     */
    public function complete()
    {
        return view('register.complete');
    }


}
