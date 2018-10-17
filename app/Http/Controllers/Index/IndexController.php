<?php

namespace App\Http\Controllers\Index;

use App\Models\Article;
use App\Service\ArticleService;
use App\Service\PlacardService;
use App\Service\TagService;
use Illuminate\Http\Request;


class IndexController extends BaseController
{
    /**
     * blog首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //bannel
        $bannels = ArticleService::articles(['is_bannel'=>1]);

        //placard
        $placards = PlacardService::placards();

        //展示的博文 articles
        $articles = ArticleService::articlesPage();

        //tags
        $tags = TagService::tags();

        //recommend
        $recommends = ArticleService::articles(['is_recommend'=>1]);

        //hot
        $hots = ArticleService::articles(['is_hot'=>1]);

        $data = [
            'bannels'      =>      $bannels,
            'placards'     =>      $placards,
            'tags'         =>      $tags,
            'articles'     =>      $articles['articles'],
            'next_page'    =>      $articles['next_page'],
            'recommends'   =>      $recommends,
            'hots'         =>      $hots
        ];

        return view('index.index.index',$data);
    }
}
