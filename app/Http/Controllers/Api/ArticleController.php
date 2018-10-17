<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/10/13
 * Time: 10:30
 */

namespace App\Http\Controllers\Api;


use App\Component\Classes\Code;
use App\Http\Controllers\Controller;
use App\Service\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 博文分页
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