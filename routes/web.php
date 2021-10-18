<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

// 会員登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('user.resister_show');
Route::post('register', 'Auth\RegisterController@post')->name('user.resister_post');
Route::get('register/confirm', 'Auth\RegisterController@confirm')->name('user.register_confirm');
Route::post('register/confirm', 'Auth\RegisterController@register')->name('user.resister_resister');
Route::get('register/complete', 'Auth\RegisterController@complete')->name('user.register_complete');


// 商品登録
Route::group(['prefix' => 'product' , 'middleware' => 'auth'],function(){
    Route::get('index','ProductController@index')->name('product.index');
    Route::get('index/{id}', 'ProductController@ajax');
    Route::post('create','ProductController@create')->name('product.create');
    Route::get('confirm','ProductController@confirm')->name('product.confirm');
    Route::post('store','ProductController@store')->name('product.store');

    // レビュー登録ページ
    Route::get('review/{id}', 'ProductController@review')->name('product.review');
    Route::post('review/confirm', 'ProductController@reviewConfirm')->name('product.review-confirm');
    Route::post('review/store', 'ProductController@reviewStore')->name('product.review-store');
    Route::get('review/complete', 'ProductController@reviewComplete')->name('product.review-complete');

    });

// 商品一覧ページ
    Route::get('product/list', 'ProductController@list')->name('product.list');
    Route::get('product/list/{id}', 'ProductController@listAjax');

// 個別詳細ページ（どこのページに帰るか残すためにPOSTでページを送信するからPOSTにした）
    Route::get('product/show/{id}', 'ProductController@show')->name('product.show');

// 商品レビュー一覧ページ
    Route::get('product/review-archive/{id}', 'ProductController@reviewArchive')->name('product.review-archive');




// 会員マイページ
Route::group(['prefix' => 'home' ,'middleware' => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('mypage','HomeController@show')->name('home.show');
    Route::get('leave','HomeController@leaveConfirm')->name('home.leave');
    Route::get('delete','HomeController@delete')->name('home.delete');

// 会員情報変更
    Route::get('edit-profile','HomeController@editProfile')->name('home.edit-profile');
    Route::post('edit-profile-post', 'HomeController@editProfilePost')->name('home.edit-profile-post');
    Route::post('edit-profile-store', 'HomeController@editProfileStore')->name('home.edit-profile-store');

// パスワード変更
    Route::get('edit-password','HomeController@editPassword')->name('home.edit-password');
    Route::post('edit-password-store', 'HomeController@editPasswordStore')->name('home.edit-password-store');

// メールアドレス変更
    Route::get('edit-email','HomeController@editEmail')->name('home.edit-email');
    Route::post('edit-email-send', 'HomeController@editEmailSend')->name('home.edit-email-send');
    Route::get('edit-email-complete-form', 'HomeController@editEmailCompleteForm')->name('home.edit-email-complete-form');
    Route::post('edit-email-complete', 'HomeController@editEmailComplete')->name('home.edit-email-complete');


    // レビュー編集
    Route::get('review-admin','HomeController@reviewAdmin')->name('home.review-admin');

    Route::get('review-edit/{id}','HomeController@reviewEdit')->name('home.review-edit');
    Route::post('review-edit/confirm', 'HomeController@reviewEditConfirm')->name('home.review-edit-confirm');
    Route::post('review-edit/store', 'HomeController@reviewEditStore')->name('home.review-edit-store');

    Route::get('review-delete/{id}','HomeController@reviewDelete')->name('home.review-delete');
    Route::post('review-delete/complete', 'HomeController@reviewDeleteComplete')->name('home.review-delete-complete');
    });


// 管理者
/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login','Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\Auth\LoginController@login');
});
/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('home','Admin\HomeController@index')->name('admin.home');

    // 会員一覧
    Route::get('members','Admin\HomeController@showMemberArchive')->name('admin.members');
    Route::get('member/edit/{id}','Admin\HomeController@memberEditShowForm')->name('admin.member-edit');
    Route::post('member/edit','Admin\HomeController@memberEditConfirm')->name('admin.member-edit-confirm');
    Route::post('member/edit/complete','Admin\HomeController@memberEditComplete')->name('admin.member-edit-complete');
    Route::get('member/register','Admin\HomeController@memberRegisterShowForm')->name('admin.member-register');
    Route::post('member/register/confirm','Admin\HomeController@memberRegisterConfirm')->name('admin.member-register-confirm');
    Route::post('member/complete','Admin\HomeController@memberRegisterComplete')->name('admin.member-register-complete');
    Route::get('member/{id}','Admin\HomeController@memberShow')->name('admin.member-show');
    Route::get('member/delete/{id}','Admin\HomeController@memberDelete')->name('admin.member-delete');


    // カテゴリ一覧
    Route::get('categories','Admin\CategoryController@showCategoryArchive')->name('admin.categories');

    Route::get('category/edit/{id}','Admin\CategoryController@categoryEditShowForm')->name('admin.category-edit');
    Route::post('category/edit','Admin\CategoryController@categoryEditConfirm')->name('admin.category-edit-confirm');
    Route::post('category/edit/complete','Admin\CategoryController@categoryEditComplete')->name('admin.category-edit-complete');

    Route::get('category/register','Admin\CategoryController@categoryRegisterShowForm')->name('admin.category-register');
    Route::post('category/register/confirm','Admin\CategoryController@categoryRegisterConfirm')->name('admin.category-register-confirm');
    Route::post('category/complete','Admin\CategoryController@categoryRegisterComplete')->name('admin.category-register-complete');

    Route::get('category/{id}','Admin\CategoryController@categoryShow')->name('admin.category-show');
    Route::get('category/delete/{id}','Admin\CategoryController@categoryDelete')->name('admin.category-delete');


    // 商品一覧
    Route::get('products','Admin\ProductController@showProductArchive')->name('admin.products');
    Route::get('product/index/{id}', 'Admin\ProductController@ajax');
    // 登録
    Route::get('product/register','Admin\ProductController@productRegisterShowForm')->name('admin.product-register');
    Route::post('product/register/confirm','Admin\ProductController@productRegisterConfirm')->name('admin.product-register-confirm');
    Route::post('product/complete','Admin\ProductController@productRegisterComplete')->name('admin.product-register-complete');

    // 編集
    Route::get('product/edit/{id}','Admin\ProductController@productEditShowForm')->name('admin.product-edit');
    Route::post('product/edit','Admin\ProductController@productEditConfirm')->name('admin.product-edit-confirm');
    Route::post('product/edit/complete','Admin\ProductController@productEditComplete')->name('admin.product-edit-complete');
    // 個別・削除
    Route::get('product/{id}','Admin\ProductController@productShow')->name('admin.product-show');
    Route::get('product/delete/{id}','Admin\ProductController@productDelete')->name('admin.product-delete');






    // レビュー一覧
    Route::get('reviews','Admin\ReviewController@showReviewArchive')->name('admin.reviews');
    Route::get('review/index/{id}', 'Admin\ReviewController@ajax');
    // 登録
    Route::get('review/register','Admin\ReviewController@reviewRegisterShowForm')->name('admin.review-register');
    Route::post('review/register/confirm','Admin\ReviewController@reviewRegisterConfirm')->name('admin.review-register-confirm');
    Route::post('review/complete','Admin\ReviewController@reviewRegisterComplete')->name('admin.review-register-complete');

    // 編集
    Route::get('review/edit/{id}','Admin\ReviewController@reviewEditShowForm')->name('admin.review-edit');
    Route::post('review/edit','Admin\ReviewController@reviewEditConfirm')->name('admin.review-edit-confirm');
    Route::post('review/edit/complete','Admin\ReviewController@reviewEditComplete')->name('admin.review-edit-complete');
    // 個別・削除
    Route::get('review/{id}','Admin\ReviewController@reviewShow')->name('admin.review-show');
    Route::get('review/delete/{id}','Admin\ReviewController@reviewDelete')->name('admin.review-delete');


});

// テスト
Route::group(['prefix' => 'test'], function() {
    Route::get('/','TestController@index')->name('test.list');

});
