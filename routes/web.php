<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Post

Route::get('/', 'PostController@index')->name('index');
Route::get('/create', 'PostController@create')->middleware('auth')->name('create');
Route::get('/edit/{id}', 'PostController@edit')->middleware('auth')->name('edit');
Route::get('/posts/{id}', 'PostController@show')->name('show');
Route::get('/replyedit/{id}', 'PostController@replyedit')->middleware('auth')->name('replyedit');
Route::get('/mypage', 'PostController@mypage')->middleware('auth')->name('mypage');
Route::get('/profile/{id}', 'PostController@profile')->name('profile');
Route::get('/rep/{id}', 'PostController@replyshow')->name('rep');
Route::get('/search', 'PostController@search')->name('serach');
Route::get('/notice', 'PostController@notice')->middleware('auth')->name('notice');

Route::post('/store', 'PostController@store')->middleware('auth')->name('store');
Route::post('/edit', 'PostController@update')->middleware('auth')->name('update');
Route::post('/delete/{id}', 'PostController@destroy')->middleware('auth')->name('destroy');
Route::post('/post/like', 'PostController@postlike')->middleware('auth')->name('postlike');
Route::post('/post/unlike', 'PostController@postunlike')->middleware('auth')->name('postunlike');
Route::post('/reply', 'PostController@replystore')->middleware('auth')->name('replystore');
Route::post('/replyedit', 'PostController@replyupdate')->middleware('auth')->name('replyupdate');
Route::post('/replydelete/{id}', 'PostController@replydestroy')->middleware('auth')->name('replydestroy');
Route::post('/mypage/profileupdate', 'PostController@myprofile')->middleware('auth')->name('myprofile');
Route::post('/mypage/profiletextupdate', 'PostController@profiletextupdate')->middleware('auth')->name('profiletextupdate');
Route::post('/mypage/nameidchange', 'PostController@nameidchange')->middleware('auth')->name('nameidchange');

// DM

Route::get('/dm', 'DMController@dmhome')->middleware('auth')->name('dmhome');
Route::get('/dmsearch', 'DMController@dmsearch')->middleware('auth')->name('dmsearch');
Route::get('/dm/{id}/{id2}', 'DMController@dm')->middleware('auth')->name('dm');

// Admin

Route::get('/setting', 'AdminController@setting')->middleware('can:owner')->name('setting');
Route::post('/setting/update', 'AdminController@settingupdate')->middleware('can:owner')->name('settingupdate');
Route::post('/setting/updateimage', 'AdminController@settingimageupdate')->middleware('can:owner')->name('settingimageupdate');
Route::post('/setting/updatename', 'AdminController@settingappnameupdate')->middleware('can:owner')->name('settingappnameupdate');
Route::post('/setting/updatedebug', 'AdminController@settingdebugupdate')->middleware('can:admin')->name('settingdebugupdate');

// AccountDelete

Route::get('/deleteaccount', function () {
    return view('delac.delac');
})->middleware('auth')->name('deleteaccount');
Route::post('/deleteaccount/Seeyoushobon', 'AccountDeleteController@AccountDelete')->middleware('auth')->name('AccountDelete');
require __DIR__.'/auth.php';

// WebPush

Route::post('/webpush/subscribe', 'WebPushController@subscribe')->middleware('auth')->name('subscribe');
Route::post('/webpush/unsubscribe', 'WebPushController@unsubscribe')->middleware('auth')->name('unsubscribe');