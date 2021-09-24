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
    Route::get('members','Admin\HomeController@showMemberArchive')->name('admin.members');


    Route::get('member/edit/{id}','Admin\HomeController@memberEditShowForm')->name('admin.member-edit');
    Route::post('member/edit','Admin\HomeController@memberEditConfirm')->name('admin.member-edit-confirm');
    Route::post('member/edit/complete','Admin\HomeController@memberEditComplete')->name('admin.member-edit-complete');


    Route::get('member/register','Admin\HomeController@memberRegisterShowForm')->name('admin.member-register');
    Route::post('member/register/confirm','Admin\HomeController@memberRegisterConfirm')->name('admin.member-register-confirm');
    Route::post('member/complete','Admin\HomeController@memberRegisterComplete')->name('admin.member-register-complete');

    Route::get('member/{id}','Admin\HomeController@memberShow')->name('admin.member-show');

    Route::get('member/delete/{id}','Admin\HomeController@memberDelete')->name('admin.member-delete');
});
