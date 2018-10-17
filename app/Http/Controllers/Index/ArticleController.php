<?php

namespace App\Http\Controllers\Index;

use App\Component\Classes\Code;
use App\Service\ArticleService;
use App\Service\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends BaseController
{
    /**
     * 文章内容页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request,int $id){

        $article = ArticleService::article($id);

        //tags
        $tags = TagService::tags();

        //hot
        $hots = ArticleService::articles(['is_hot'=>1]);

        $data = [
            'article'      =>      $article,
            'tags'         =>      $tags,
            'hots'         =>      $hots,
            'prevArticle'  =>      ArticleService::prevArticle($article),
            'nextArticle'  =>      ArticleService::nextArticle($article)
        ];



        if($article){
            return view('index.article.article',$data);
        }else{
            dd(404);
        }

    }

    /**
     * ajax获得博文分页数据
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function articlePage(Request $request){
        $data = $request->all();
        $articles = ArticleService::articlesPage($data);
        if($articles['articles']){
            return $this->setResponse($articles)->response();
        }else{
            return $this->setResponse([],Code::FAILED,'沒有数据了')->response();
        }
    }
}
