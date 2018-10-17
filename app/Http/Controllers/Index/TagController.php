<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/10/14
 * Time: 15:45
 */

namespace App\Http\Controllers\Index;


use App\Component\Classes\Code;
use App\Models\Tag;
use App\Service\ArticleService;
use App\Service\TagService;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * 所有标签
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $tags = TagService::tags();
        return view('index.tag.index',['tags'=>$tags]);
    }

    /**
     * 标签
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag(Tag $tag){

        //根据标签id获得文章
        $articles = ArticleService::tagArticles($tag->tag_id);

        $data = [
            'tag'    =>   $tag,
            'articles'   =>   $articles['articles'],
            'next_page'  =>   $articles['next_page'],
            'count'      =>   $articles['count']
         ];
        return view('index.tag.tag',$data);
    }

    public function ajaxTagArticle(Request $request){
        $data = $request->all();
        $articles = ArticleService::tagArticles($data['tag_id']);
        if($articles['articles']){
            return $this->setResponse($articles)->response();
        }else{
            return $this->setResponse([],Code::FAILED,'沒有数据了')->response();
        }
    }
}
