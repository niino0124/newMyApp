<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

// 追加(1937)
    public function username()
    {
        return 'login_id';
    }

    // protected $redirectTo = RouteServiceProvider::ADMIN_HOME;
    protected $redirectTo = '/admin/home'; // 変更

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request)
    {

        Auth::guard('admin')->logout();  //変更
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/admin/login');  //変更
    }
}
