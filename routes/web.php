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

Route::get('/', function(){
    return view('winner')->with('prizes',\App\PrizeType::all());
});

Auth::routes();

Route::group(['middleware'=>'auth'],function (){

    Route::resource('/admin/user', 'Admin\UserController')->middleware('admin');
    //we can create user/ delete / update/ approve user , other function like change password.

    Route::post('admin/user/reset', 'Admin\UserController@reset')->middleware('admin');

    Route::get('/admin/lucky/draw','Admin\LuckyDrawController@index')->middleware('admin');

    Route::post('/admin/lucky/draw','Admin\LuckyDrawController@create')->middleware('admin');

    Route::post('/admin/lucky/reset','Admin\LuckyDrawController@reset')->middleware('admin');

    Route::get('/home', 'HomeController@index')->name('home')->middleware('user');

    Route::post('/user/draw', 'HomeController@draw')->middleware('user');

});
