<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;

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

    // public function showMemberArchiveOrder(Request $request){
    //     $order = $request->order;
    //       //セッションに書き込む
    //     $request->session()->put("order", $order);
    //     return $order = $request->session()->get("order");

    // }

    // function fetch_data(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $sort_by = $request->get('sortby');
    //   $sort_type = $request->get('sorttype');
    //         $query = $request->get('query');
    //         $query = str_replace(" ", "%", $query);
    //   $data = DB::table('post')
    //                 ->where('id', 'like', '%'.$query.'%')
    //                 ->orWhere('post_title', 'like', '%'.$query.'%')
    //                 ->orWhere('post_description', 'like', '%'.$query.'%')
    //                 ->orderBy($sort_by, $sort_type)
    //                 ->paginate(5);
    //   return view('pagination_data', compact('data'))->render();
    //  }
    // }


}
