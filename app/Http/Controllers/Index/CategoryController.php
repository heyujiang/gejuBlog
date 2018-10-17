<?php

namespace App\Http\Controllers\Index;

use App\Models\Category;
use App\Service\ArticleService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * 一个文章分类页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Category $category){

        //获得一个分类的文章 第一页的

        $articles = ArticleService::articlesPage(['category_id'=>$category->category_id]);

        $data = [
            'category'   =>   $category,
            'articles'   =>   $articles['articles'],
            'next_page'  =>   $articles['next_page'],
            'count'      =>   $articles['count']
        ];

        return view('index.category.category',$data);
    }
}
