<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/8/22
 * Time: 21:54
 */

Route::namespace('Admin')->middleware(['auth','manager'])->group(function (){
    //后台框架首页
    Route::get('/','IndexController@index');
    //控制台
    Route::get('console','IndexController@console');

    //导航相关
    Route::prefix('navigation')->group(function (){
        //导航列表
        Route::get('/','NavigationController@index');

        //创建导航页面
        Route::get('create','NavigationController@create');

        //创建导航时 保存导航数据
        Route::post('store','NavigationController@store');

        //删除导航
        Route::get('del/{id}','NavigationController@destroy');

        //编辑导航 页面
        Route::get('edit/{id}','NavigationController@edit');

        //编辑导航 保存编辑的数据
        Route::post('update/{id}','NavigationController@update');

        //修改导航排序
        Route::get('up-sort/{navigation}','NavigationController@upSort');
    });

    //公告相关 placard
    Route::prefix('placard')->group(function (){
        //后台公告列表页面
        Route::get('/','PlacardController@index');
        //后台公告里列表数据
        Route::get('placard-list','PlacardController@placardList');
        //后台创建公告页面
        Route::get('create','PlacardController@create');
        //后台创建公告保存数据
        Route::post('store','PlacardController@store');
        //删除公告
        Route::get('del/{placard}','PlacardController@destroy');
        //批量删除
        Route::get('batch-del','PlacardController@batchDel');
        //隐藏 | 显示
        Route::get('up-show-status/{placard}','PlacardController@upShowStatus');
        //修改排序
        Route::get('up-sort/{placard}','PlacardController@upSort');
        //编辑公告 页面
        Route::get('edit/{placard}','PlacardController@edit');
        //修改公告
        Route::post('update/{placard}','PlacardController@update');
    });

    //标签 Tags
    Route::prefix('tag')->group(function (){
        //数据分页列表
        Route::post('tag-list','TagController@tagList');
        //批量删除
        Route::get('batch-del','TagController@destoryBatch');
        //标签排序
        Route::get('up-sort/{tag}','TagController@upSort');
    });
    Route::resource('tag','TagController');


    //分类 Category
    Route::prefix('category')->group(function (){
        //数据分页列表
        Route::post('category-list','CategoryController@categoryList');
        //批量删除
        Route::delete('category-batch-del','CategoryController@destoryBatch');
        //修改排序
        Route::get('up-sort/{category}','CategoryController@upSort');
    });
    Route::resource('category','CategoryController');


    //博文 Article
    Route::prefix('article')->group(function (){
        //数据分页列表
        Route::get('article-list','ArticleController@articleList');
        //批量删除
        Route::delete('article-batch-del','ArticleController@destoryBatch');
        //修改排序值
        Route::get('up-sort/{article}','ArticleController@upSort');
        //草稿页面
        Route::get('draft','ArticleController@draft');
        //草稿数据
        Route::get('draft-list','ArticleController@draftList');
        //修改博文置顶
        Route::get('up-top/{article}','ArticleController@upTop');
        //博文是否加入轮播图
        Route::get('up-bannel/{article}','ArticleController@upBannel');
        //博文是否推荐
        Route::get('up-recommend/{article}','ArticleController@upRecommend');
        //发布博文
        Route::get('release/{article}','ArticleController@release');

        //废纸篓 页面 数据
        Route::get('trash','ArticleController@trash');
        Route::get('trash-list','ArticleController@trashList');
        Route::get('restore/{article}','ArticleController@restore');
    });
    Route::resource('article','ArticleController');

    //系统
    Route::prefix('system')->group(function (){
        //解锁页面
        Route::get('unlock','SystemController@unlock');
        //控制面板
        Route::get('control-panel','SystemController@controlPanel');
    });

    Route::prefix('tools')->group(function (){
       Route::post('upload-image','Tools\ImageController@upload');
       Route::post('upload-article-editor-image','Tools\ImageController@articleEditorUpload');
       Route::post('upload-article-image','Tools\ImageController@articleUpload');

       Route::get('unlink-img','Tools\ImageController@unlinkImg');
    });
});