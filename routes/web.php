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

Route::resource('articles', 'ArticleController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('tags/{tags}', 'TagsController@show')->name('tagShow');
Route::get('tags', 'TagsController@showAllTags')->name('tagAll');

Route::post('comments/{id}', 'CommentController@storeComment')->name('commentStore');
Route::delete('comments/{id}', 'CommentController@deleteComment')->name('commentDelete');
