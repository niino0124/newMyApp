<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
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
}
