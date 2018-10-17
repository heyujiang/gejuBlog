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

Route::namespace('Index')->group(function (){
    Route::get('/', 'IndexController@index');

    Route::get('article/{id}','ArticleController@index');

    Route::get('tag/{tag}','TagController@index');

    Route::get('category/{category}','CategoryController@index');

    Route::get('article_page','ArticleController@articlePage');


    Route::get('tag','TagController@index');

    Route::get('tag/{tag}','TagController@tag');

    Route::get('s','SearchController@index');

    Route::get('tag_article_page','TagController@ajaxTagArticle');



    //测试
    Route::get('status','TestController@status');
});

Auth::routes();