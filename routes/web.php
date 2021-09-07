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
});

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
    });

// 商品一覧ページ
    Route::get('product/list', 'ProductController@list')->name('product.list');
    Route::get('product/list/{id}', 'ProductController@listAjax');

// 個別詳細ページ
    Route::get('product/show/{id}', 'ProductController@show')->name('product.show');

// レビュー登録ページ
    Route::get('product/review/{id}', 'ProductController@review')->name('product.review');
    Route::post('product/review/confirm', 'ProductController@reviewConfirm')->name('product.review-confirm');
    Route::post('product/review/store', 'ProductController@reviewStore')->name('product.review-store');

 

// Route::get('product-register', 'ProductController@showRegistrationForm')->name('product.resister_show');
// Route::post('product-register', 'ProductController@validation')->name('product.validation');

// Route::get('product-register/confirm', "ProductController@confirm")->name('product.confirm');
// Route::post('product-register/confirm', "ProductController@send")->name('product.send');



Route::get('/home', 'HomeController@index')->name('home');
