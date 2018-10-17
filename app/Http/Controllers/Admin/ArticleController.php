<?php

namespace App\Http\Controllers\Admin;

use App\Component\Classes\Code;
use App\Models\Article;
use App\Service\ArticleService;
use App\Service\CategoryService;
use App\Service\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateList = CategoryService::index();
        $tags = TagService::tags();
        return view('admin.article.create',['type'=>Article::TYPE,'cateList'=>$cateList,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['file']);
        $articleService = new ArticleService();
        return $articleService->storeArticle($data)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //所有分类
        $cateList = CategoryService::index();

        //所有标签
        $tags = TagService::tags();

        //文章标签
        $article_tags = $article->tags()->get();

        //所有tag_id数组
        $article_tag_ids = collect($article_tags)->pluck('tag_id')->all();

        return view('admin.article.edit',['article'=>$article,'type'=>Article::TYPE,'cateList'=>$cateList,'tags'=>$tags,'article_tags'=>$article_tags,'article_tag_ids'=>$article_tag_ids]);
    }

    /**
     * Update the specified resource in storage
     * @param Request $request
     * @param Article $article
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->all();
        unset($data['file']);
        $articleService = new  ArticleService();
        return $articleService->updateArticle($article,$data)->response();
    }

    /**
     * Remove the specified resource from storage.
     * @param Article $article
     * @return ArticleController|array|\Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        if($article->is_del == Article::DEL_YES)
            return $this->setResponse($article,Code::FAILED,'文章已删除，不可二次删除');
        $articleService = new ArticleService();
        return $articleService->update($article,['is_del'=>Article::DEL_YES])->response();
    }

    /**
     * 文章列表
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function articleList(Request $request){
        $data = $request->all();
        $articleService = new ArticleService();
        return $articleService->articleList($data)->response();
    }

    /**
     * 草稿列表 页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draft(){
        return view('admin.article.draft');
    }

    /**
     * 草稿列表 数据
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function draftList(Request $request){
        $data = $request->all();
        $articleService = new ArticleService();
        return $articleService->articleList($data,Article::RELEASE_NO)->response();
    }

    /**
     * 批量删除
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destoryBatch(Request $request){
        $post = $request->getContent();
        $data = json_decode($post,true);
        $articleService = new ArticleService();
        return $articleService->articleList($data['id'])->response();

    }

    /**
     * 修改排序
     * @param Article $article
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upSort(Article $article,Request $request){
        $post = $request->all();
        if(!(isset($post['sort'])&&$post['sort']))
            return $this->setResponse([],Code::FAILED,'请填写修改的排序值')->response();
        $articleService = new ArticleService();
        return $articleService->update($article,$post)->response();
    }

    /**
     * 修改博文置顶状态
     * @param Article $article
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upTop(Article $article){
        $update = ['is_top'=>Article::TOP_YES];
        if ($article->is_top == Article::TOP_YES) {
            $update['is_top'] = Article::TOP_NO;
        }
        $articleService = new ArticleService();
        return $articleService->update($article,$update)->response();
    }

    /**
     * 修改博文是否加入轮播图
     * @param Article $article
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upBannel(Article $article){
        $update = ['is_bannel'=>Article::BANNEL_YES];
        if ($article->is_bannel == Article::BANNEL_YES) {
            $update['is_bannel'] = Article::BANNEL_NO;
        }
        $articleService = new ArticleService();
        return $articleService->update($article,$update)->response();
    }

    /**
     * 修改博文是否推荐
     * @param Article $article
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upRecommend(Article $article){
        $update = ['is_recommend'=>Article::RECOMMEND_YES];
        if ($article->is_recommend == Article::RECOMMEND_YES) {
            $update['is_recommend'] = Article::RECOMMEND_NO;
        }
        $articleService = new ArticleService();
        return $articleService->update($article,$update)->response();
    }

    /**
     * 发布
     * @param Article $article
     * @return ArticleController|array|\Illuminate\Http\JsonResponse
     */
    public function release(Article $article){
        if($article->is_ralease == Article::RECOMMEND_YES)
            return $this->setResponse($article,Code::FAILED,'文章已发布，不可二次发布');
        $articleService = new ArticleService();
        return $articleService->update($article,['is_release'=>Article::RECOMMEND_YES])->response();
    }


    /**
     * 废纸篓列表 页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash(){
        return view('admin.article.trash');
    }

    /**
     * 废纸篓列表 数据
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function trashList(Request $request){
        $data = $request->all();
        $articleService = new ArticleService();
        return $articleService->trashList($data)->response();
    }

    /**
     * 将删除的文章回复正常
     * @param Article $article
     * @return ArticleController|array|\Illuminate\Http\JsonResponse
     */
    public function restore(Article $article){
        if($article->is_del == Article::DEL_NO)
            return $this->setResponse($article,Code::FAILED,'文章正常，不可进行此操作');
        $articleService = new ArticleService();
        return $articleService->update($article,['is_del'=>Article::DEL_NO])->response();
    }
}
