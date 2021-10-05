<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewForm;
use Illuminate\Http\Request;
use App\Review;

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
            // dump('全件表示');
        }else{
            // dump('検索表示');
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
        $back_url = $request->session()->get("now_route");
        return view('admin.review-register-edit',compact('back_url'));
    }

    public function reviewEditShowForm(Request $request, $id){

        $review = Review::with('product')->find($id);
        $back_url = $request->session()->get("now_route");

        return view('admin.review-register-edit',compact('review','back_url'));
    }






    public function reviewEditConfirm(StoreReviewForm $request){

            // 取り出し
            $id = $request->id;
            $name = $request->name;
            $sub_name0 = $request->sub_name0;

            // 確認画面に表示する値を格納
            $input = [
                'id' => $id,
                'name' => $name,
                'sub_name0' => $sub_name0,

            ];

        return view('admin.review-register-edit-confirm', compact('input') );
    }

        public function reviewRegisterConfirm(StoreReviewForm $request){
            // 取り出し
            $name = $request->name;
            $sub_name0 = $request->sub_name0;
            // 確認画面に表示する値を格納
            $input = [
                'name' => $name,
                'sub_name0' => $sub_name0,
            ];

            return view('admin.review-register-edit-confirm', compact('input') );
        }


    public function reviewEditComplete(Request $request){
        $id = $request->id;

        if ($request->get('back')) {
            return redirect()->route('admin.review-edit', ['id' => $id])
            ->withInput();
        }

        // 商品大カテゴリのnameを更新
        $new_review = ProductReview::find($id);
        $new_review->name = $request->name;
        $new_review->save();

        $subreview = ProductSubreview::where('product_review_id',$id);
        // 物理削除
        $subreview->delete();

        $new_subreview0 = new ProductSubreview;
        $new_subreview0->product_review_id = $id;
        $new_subreview0->name = $request->sub_name0;
        $new_subreview0->save();

        return redirect()->route('admin.reviews');
    }

    public function reviewRegisterComplete(Request $request){
        if ($request->get('back')) {
            return redirect()->route('admin.review-register')
            ->withInput();
        }

        // 商品大カテゴリのnameを更新
        $new_review = new ProductReview;
        $new_review->name = $request->name;
        $new_review->save();

        $id = ProductReview::pluck('id')->last();

        $new_subreview0 = new ProductSubreview;
        $new_subreview0->product_review_id = $id;
        $new_subreview0->name = $request->sub_name0;
        $new_subreview0->save();


        return redirect()->route('admin.reviews');
    }



    // 詳細ページ
    public function reviewShow(Request $request,$id){
        $review = ProductReview::find($id);
        $sub_reviews = ProductSubreview::where('product_review_id',$id)->select(['id','name'])->get();

        $back_url = $request->session()->get("now_route");
        return view('admin.review-show', compact('review','sub_reviews','back_url') );
    }

    // 削除
    public function reviewDelete($id){
        ProductReview::find($id)->delete();
        return redirect()->route('admin.reviews');
    }

}
