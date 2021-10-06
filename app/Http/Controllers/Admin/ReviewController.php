<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewForm;
use Illuminate\Http\Request;
use App\Review;
use App\Product;
use App\Member;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


// 一覧表示と検索
    public function showReviewArchive(Request $request){
        $id = $request->input('id');
        $search = $request->input('search');
        $query = Review::query();

        if($id == null && $search == null){
        }else{
            if($id != 0){
                $query->where('id',$id);
            };

            if($search != null){
                $search_split = mb_convert_kana($search,'s');
                $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

                foreach($search_split2 as $value)
                {
                    $query->where('comment','LIKE','%'.$value.'%');
                }
            };
        }
        $reviews = $query->sortable()->orderBy('id', 'desc')->paginate(10);
        $back_url = null;
        $now_route = url()->full();
        session(['now_route' => $now_route]);
        $back_url = session('now_route');

        return view('admin.review-archive',compact('reviews'));
    }



    // フォーム出力
    public function reviewRegisterShowForm(Request $request){

        $product =  Product::inRandomOrder()->first();

        $back_url = $request->session()->get("now_route");
        return view('admin.review-register-edit',compact('product','back_url'));
    }

    public function reviewEditShowForm(Request $request, $id){
        $review = Review::with('product')->find($id);
        $back_url = $request->session()->get("now_route");
        return view('admin.review-register-edit',compact('review','back_url'));
    }


    public function reviewEditConfirm(StoreReviewForm $request){

            $id = $request->id;
            $product_id = $request->product_id;

            // 表示のため使いまわしたいから
            $name = $request->product_name;
            $image_1 = $request->product_image_1;
            $avg_evaluation = $request->product_avg_evaluation;

            $evaluation = $request->evaluation;
            $comment = $request->comment;

            // 確認画面に表示する値を格納
            $input = [
                'id' => $id,
                'product_id' => $product_id,
                'name' => $name,
                'image_1' => $image_1,
                'avg_evaluation' => $avg_evaluation,
                'evaluation' => $evaluation,
                'comment' => $comment,
            ];

            $back_url = $request->session()->get("now_route");
        return view('admin.review-register-edit-confirm', compact('input','back_url') );
    }

        public function reviewRegisterConfirm(StoreReviewForm $request){

            $product_id = $request->product_id;

            // 表示のため使いまわしたいから
            $name = $request->product_name;
            $image_1 = $request->product_image_1;
            $avg_evaluation = $request->product_avg_evaluation;

            $evaluation = $request->evaluation;
            $comment = $request->comment;


            $input = [
                'product_id' => $product_id,
                'name' => $name,
                'image_1' => $image_1,
                'avg_evaluation' => $avg_evaluation,
                'evaluation' => $evaluation,
                'comment' => $comment,
            ];
            // 編集との違いは$input['id']があるかないか

            $back_url = $request->session()->get("now_route");
            return view('admin.review-register-edit-confirm', compact('input','back_url') );
        }


    public function reviewEditComplete(Request $request){
        $id = $request->id;

        if ($request->get('back')) {
            return redirect()->route('admin.review-edit', ['id' => $id])
            ->withInput();
        }

        // 当該のレビューを更新
        $review = Review::find($id);
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('admin.reviews');
    }

    public function reviewRegisterComplete(Request $request){

        // 戻る際に商品情報はいらないだろうか？
        if ($request->get('back')) {
            return redirect()->route('admin.review-register')
            ->withInput();
        }

        // レビューを登録したメンバーをランダムで選出
        $member_id =  Member::inRandomOrder()->first()->id;

        // 当該のレビューを更新
        $review = new Review;

        $review->member_id = $member_id;
        
        $review->product_id = $request->product_id;
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;

        $review->save();

        return redirect()->route('admin.reviews');
    }



    // 詳細ページ
    public function reviewShow(Request $request,$id){
        $review = Review::with('product')->find($id);
        // dd($review->product->getAvgStarAttribute);
        $back_url = $request->session()->get("now_route");
        return view('admin.review-show', compact('review','back_url') );
    }

    // 削除
    public function reviewDelete($id){
        Review::find($id)->delete();
        return redirect()->route('admin.reviews');
    }

}
