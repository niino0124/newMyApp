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







Route::group(['prefix' => 'home' ,'middleware' => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('mypage','HomeController@show')->name('home.show');
    Route::get('leave','HomeController@leaveConfirm')->name('home.leave');
    Route::get('delete','HomeController@delete')->name('home.delete');

// 会員情報
    Route::get('edit-profile','HomeController@editProfile')->name('home.edit-profile');
    Route::post('edit-profile-post', 'HomeController@editProfilePost')->name('home.edit-profile-post');
    Route::post('edit-profile-store', 'HomeController@editProfileStore')->name('home.edit-profile-store');

// パスワード
    Route::get('edit-password','HomeController@editPassword')->name('home.edit-password');
    Route::post('edit-password-store', 'HomeController@editPasswordStore')->name('home.edit-password-store');



// メールアドレス変更フォームを表示
    Route::get('edit-email','HomeController@editEmail')->name('home.edit-email');
// メールアドレス変更情報をバリデート。auth_codeを登録。
    Route::post('edit-email-send', 'HomeController@editEmailSend')->name('home.edit-email-send');
// auth_codeが一致したらメールアドレスを新しいのに変更。マイページへリダイレクト。
    Route::get('edit-email-complete-form', 'HomeController@editEmailCompleteForm')->name('home.edit-email-complete-form');
    Route::post('edit-email-complete', 'HomeController@editEmailComplete')->name('home.edit-email-complete');


    Route::get('review-admin','HomeController@reviewAdmin')->name('home.review-admin');

    });
