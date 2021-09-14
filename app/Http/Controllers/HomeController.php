<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Member;
use App\Review;
use App\Rules\Hankaku;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\StoreReviewForm;


use Illuminate\Support\Facades\Mail;
use App\Mail\AuthMail;



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

    protected function validatorAuth(array $data)
    {
        return Validator::make($data, [
            "email" =>  [],
            "auth_code" =>  [],
            "auth_code_input" =>  ['required', 'integer', 'same:auth_code'],
        ]);
    }

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
            Mail::to($email)->send(new AuthMail($str));
            $auth_code = $member->auth_code;
            return redirect()->route('home.edit-email-complete-form',compact('email','auth_code'));
        }

        public function editEmailCompleteForm(Request $request){
            $email = $request->email;
            $auth_code = $request->auth_code;
            return view('edit-email-confirm',compact('email','auth_code'));
        }


        public function  editEmailComplete(Request $request)
        {
            // バリデーション
            $this->validatorAuth($request->all())->validate();
            // バリデーション通ったら入力値を変数に代入
            $email = $request->email;
            // 会員情報の更新
            $id = Auth::id();
            $member = Member::find($id);
            // 新しいメールアドレスに更新
            $member->email = $email;
            $member->save();
            return redirect()->route('home.show');
        }


// 商品レビュー管理
        public function  reviewAdmin()
        {
            $id = Auth::id();
            $reviews = Review::where('member_id',$id)
            ->with('product.productCategory.productSubcategory')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

            $back_url = null;
            $now_route = url()->full();
            session(['now_route' => $now_route]);
            $back_url = session('now_route');
            // dump($back_url);

            return view('review-admin',compact('reviews'));
        }

        public function  reviewEdit(Request $request,$id)
        {
            $back_url = $request->session()->get("now_route");

            $infos = Review::where('id',$id)
            ->with('product')
            ->get();
            return view('review-edit',compact('infos','back_url'));
        }

        public function reviewEditConfirm(StoreReviewForm $request)
        {
            $comment = $request->comment;
            $evaluation = $request->evaluation;

            $name = $request->name;
            $image_1 = $request->image_1;
            $avg_evaluation = $request->avg_evaluation;
            $product_id = $request->product_id;
            // レビューID
            $id = $request->id;


            // 確認画面に表示する値を格納
            $input_data = [
                'comment' => $comment,
                'evaluation' => $evaluation,
                'name' => $name,
                'image_1' => $image_1,
                'avg_evaluation' => $avg_evaluation,
                'product_id' => $product_id,
                'id' => $id
            ];
            return view('review-edit-confirm',compact('input_data'));
        }

        public function reviewEditStore(Request $request)
            {
                $id = $request->id;
                if ($request->get('back')) {
                    return redirect()->route('home.review-edit', ['id' => $id])
                    ->withInput();
                }

                $review = Review::where('id',$id)
                ->first();
                $review->evaluation = $request->evaluation;
                $review->comment = $request->comment;
                $review->save();
                return redirect()->route('home.review-admin');

            }

            public function  reviewDelete(Request $request ,$id)
            {
                $back_url = $request->session()->get("now_route");

                $infos = Review::where('id',$id)
                ->with('product')
                ->get();

                return view('review-delete-confirm',compact('infos','back_url'));
            }

            public function  reviewDeleteComplete(Request $request)
            {
                $id = $request->id;

                Review::find($id)->delete();

                return redirect()->route('home.review-admin');
            }

}
