<?php

namespace App\Http\Controllers\Index;

use App\Service\ArticleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends BaseController
{
    public function index(Request $request){
        $title = $request->input('s');
        $articles = ArticleService::articlesPage(['title'=>$title]);
        $data = [
            'title'       =>    $title,
            'articles'    =>    $articles['articles'],
            'next_page'   =>    $articles['next_page'],
            'count'       =>    $articles['count']
        ];
        return view('index.search.search',$data);
    }
}
