<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/9/21
 * Time: 17:01
 */

namespace App\Service;


use App\Component\Classes\Code;
use App\Component\Classes\Message;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Support\Facades\DB;



class ArticleService extends Serivce
{
    /**
     * 分页获取文章
     * @param array $attributes
     * @param int $release
     * @return ArticleService
     */
    public function articleList(array $attributes = [],int $release = Article::RELEASE_YES) : ArticleService
    {
        $query = Article::query();
        $query->where('is_release',$release);
        if(isset($attributes['title'])&&$attributes['title'])
            $query->where('title','like',"%{$attributes['title']}%");
        $articles = $query->where('is_del',Article::DEL_NO)
            ->orderByDesc('sort')
            ->orderByDesc('is_top')
            ->paginate(15);

        $article_list = collect($articles->items())->each(function ($item){
            $item->cover_img = asset($item->cover_img);
            $item->type_tag = Article::TYPE_TAG[$item->type];
            $item->type_color = Article::TYPE_COLOR[$item->type];
            return $item;
        });

        return $this->setResponse([
            'articles'=>$article_list,
            'total'=>$articles->total(),
            'per_page'=>$articles->perPage(),
            'currentPage'=>$articles->currentPage()
        ]);
    }

    /**
     * 保存文章
     * @param array $attributes
     * @return ArticleService
     */
    public function storeArticle(array $attributes = []) : ArticleService
    {
        //是否置顶
        if(isset($attributes['is_top'])){
            $attributes['is_top'] = Article::TOP_YES;
        }
        //是否是轮播
        if(isset($attributes['is_bannel'])){
            $attributes['is_bannel'] = Article::BANNEL_YES;
        }
        //是否推荐
        if(isset($attributes['is_recommend'])){
            $attributes['is_recommend'] = Article::RECOMMEND_YES;
        }
        if(isset($attributes['tag_ids'])&&$attributes['tag_ids']){
            $tag_ids = $attributes['tag_ids'];
            unset($attributes['tag_ids']);
        }

        $article = new Article();
        DB::beginTransaction();
        try{
            if(!$article->fill($attributes)->save()){
                DB::rollback();
                return $this->setResponse($attributes,Code::FAILED,Message::FAILED);
            }

            if(!empty($tag_ids)){
                $article_tag = [];
                foreach ($tag_ids as $key=>$tag_id){
                    $article_tag[$key]['article_id'] = $article->article_id;
                    $article_tag[$key]['tag_id'] = $tag_id;
                }
                if(!ArticleTag::insert($article_tag)){
                    DB::rollback();
                    return $this->setResponse($attributes,Code::FAILED,Message::FAILED);
                }
            }
            DB::commit();
            return $this;
        }catch (\Exception $e){
            DB::rollback();
            return $this->setResponse($attributes,Code::FAILED,$e->getMessage() .'|' .$e->getLine());
        }
    }

    /**
     * 修改文章
     * @param Article $article
     * @param array $attributes
     * @return ArticleService
     */
    public function updateArticle(Article $article,array $attributes = []):ArticleService
    {
        //是否置顶
        if(isset($attributes['is_top'])){
            $attributes['is_top'] = Article::TOP_YES;
        }else{
            $attributes['is_top'] = Article::TOP_NO;
        }
        //是否是轮播
        if(isset($attributes['is_bannel'])){
            $attributes['is_bannel'] = Article::BANNEL_YES;
        }else{
            $attributes['is_bannel'] = Article::BANNEL_NO;
        }
        //是否推荐
        if(isset($attributes['is_recommend'])){
            $attributes['is_recommend'] = Article::RECOMMEND_YES;
        }else{
            $attributes['is_recommend'] = Article::RECOMMEND_NO;
        }
        if(isset($attributes['tag_ids'])&&$attributes['tag_ids']){
            $tag_ids = $attributes['tag_ids'];
            unset($attributes['tag_ids']);
        }
        $oldCoverImg = $article->cover_img;
        DB::beginTransaction();
        try{
            if(!$article->update($attributes)){
                DB::rollback();
                return $this->setResponse($attributes,Code::FAILED,Message::FAILED.'aaaa');
            }

            if(!empty($tag_ids)){
                $article_tag = [];
                foreach ($tag_ids as $key=>$tag_id){
                    $article_tag[$key]['article_id'] = $article->article_id;
                    $article_tag[$key]['tag_id'] = $tag_id;
                }
                //先删除之前的对应的文章-标签关系
                if(ArticleTag::where('article_id',$article->article_id)->first()){
                    if(!ArticleTag::where('article_id',$article->article_id)->delete()){
                        DB::rollback();
                        return $this->setResponse($attributes,Code::FAILED,Message::FAILED.'bbbbbb');
                    }
                }

                if(!ArticleTag::insert($article_tag)){
                    DB::rollback();
                    return $this->setResponse($attributes,Code::FAILED,Message::FAILED);
                }

                //删除在硬盘中的替换掉的图片
                if($attributes['cover_img'] != $oldCoverImg){
                    unlinkImg($oldCoverImg);
                }
            }
            DB::commit();
            return $this;
        }catch (\Exception $e){
            DB::rollback();
            return $this->setResponse($attributes,Code::FAILED,$e->getMessage() .'|' .$e->getLine());
        }
    }

    /**
     * 删除文章
     * @param Article $article
     * @return $this|ArticleService
     * @throws \Exception
     */
    public function deleteArticle(Article $article){
        $delete = ['del_status'=>Article::DEL_YES];
        return self::update($article,$delete);
    }

    /**
     * 批量删除
     * @param array $ids
     * @return ArticleService
     */
    public function destoryBatch(array $ids = []) : ArticleService {
        if(empty($ids))
            $this->setResponse([],Code::FAILED,Message::FAILED);
        if(!Article::whereIn('Article_id',$ids))
            $this->setResponse([],Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 修改文章 （暂时只修改排序 、删除状态）
     * @param Article $article
     * @param array $attributes
     * @return ArticleService
     */
    public function update(Article $article,array $attributes = []):ArticleService
    {
        if(empty($attributes))
            return $this->setResponse([],Code::FAILED,'修改项不可为空');
        if(isset($attributes['sort'])&&$attributes['sort'])
            $article->sort = $attributes['sort'];
        if(isset($attributes['is_del'])&&$attributes['is_del'])
            $article->is_del = $attributes['is_del'];
        if(isset($attributes['is_top'])&&$attributes['is_top'])
            $article->is_top = $attributes['is_top'];
        if(isset($attributes['is_bannel'])&&$attributes['is_bannel'])
            $article->is_bannel = $attributes['is_bannel'];
        if(isset($attributes['is_recommend'])&&$attributes['is_recommend'])
            $article->is_recommend = $attributes['is_recommend'];
        if(isset($attributes['is_release'])&&$attributes['is_release'])
            $article->is_release = $attributes['is_release'];
        if(!$article->save())
            return $this->setResponse([],Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 分页获取文章
     * @param array $attributes
     * @param int $release
     * @return ArticleService
     */
    public function trashList(array $attributes = []) : ArticleService
    {
        $query = Article::query();

        if(isset($attributes['title'])&&$attributes['title'])
            $query->where('title',$attributes['title']);

        $articles = $query->where('is_del',Article::DEL_YES)->paginate(15);

        $article_list = collect($articles->items())->each(function ($item){
            $item->cover_img = asset($item->cover_img);
            $item->type_tag = Article::TYPE_TAG[$item->type];
            $item->type_color = Article::TYPE_COLOR[$item->type];
            return $item;
        });

        return $this->setResponse([
            'articles'=>$article_list,
            'total'=>$articles->total(),
            'per_page'=>$articles->perPage(),
            'currentPage'=>$articles->currentPage()
        ]);
    }


    /**
     * 首页所需的文章数据
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function articles(array $attributes = []){
        $query = Article::query()
            ->where('is_del',Article::DEL_NO)
            ->where('is_release',Article::RELEASE_YES);

        //bannel
        if(isset($attributes['is_bannel']))
            $query->where('is_bannel',Article::BANNEL_YES);

        //racommend
        if(isset($attributes['is_recommend']))
            $query->where('is_recommend',Article::RECOMMEND_YES);

        //hot
        if(isset($attributes['is_hot']))
            $query->orderByDesc('readed_num');


        return $query
            ->with(['tags'=>function($query){
                $query->select(['tags.tag_id','tags.name']);
            }])
            ->with(['category'=>function($query){
                $query->select(['category_id','name']);
            }])
            ->with(['user'=>function($query){
                $query->select(['id','name','avatar']);
            }])
            ->orderByDesc('sort')
            ->select(DB::raw('article_id,title,subtitle,readed_num,created_at,cover_img,category_id,comment_num,collect_num,user_id'))
            ->limit(5)
            ->get();
    }

    /**
     * 博文分页数据
     * @param array $attributes
     * @return array
     */
    public static function articlesPage(array $attributes = []){
        $query = Article::query()->where('is_del',Article::DEL_NO)
            ->where('is_release',Article::RELEASE_YES);

        //按分类
        if(isset($attributes['category_id'])&&$attributes['category_id'])
            $query->where('category_id',$attributes['category_id']);

        //根据博文题目搜索
        if(isset($attributes['title'])&&$attributes['title'])
            $query->where('title','LIKE',"%{$attributes['title']}%");


        $articles = $query
            ->with(['tags'=>function($query){
                $query->select(['tags.tag_id','tags.name']);
            }])
            ->with(['category'=>function($query){
                $query->select(['category_id','name']);
            }])
            ->with(['user'=>function($query){
                $query->select(['id','name','avatar']);
            }])
            ->orderByDesc('sort')
            ->select(DB::raw('article_id,title,subtitle,readed_num,created_at,cover_img,type,category_id,comment_num,collect_num,user_id'))
            ->paginate(12);

        return [
            'articles'   =>  $articles->items(),
            'next_page'  =>  $articles->currentPage() + 1,
            'count'      =>  $articles->total()
        ];
    }


    /**
     * 文章详情数据
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function article(int $id){
        $query = Article::query()
            ->where('article_id',$id)
            ->where('is_del',Article::DEL_NO)
            ->where('is_release',Article::RELEASE_YES);

        return $query
            ->with(['tags'=>function($query){
                $query->select(['tags.tag_id','tags.name']);
            }])
            ->with(['category'=>function($query){
                $query->select(['category_id','name']);
            }])
            ->with(['user'=>function($query){
                $query->select(['id','name','avatar']);
            }])
            ->select(DB::raw('article_id,title,content,subtitle,created_at,cover_img,readed_num,category_id,comment_num,collect_num,user_id'))
            ->first();
    }


    public static function tagArticles(int $tag_id)
    {
        $articles =  Article::query()->join('article_tag','articles.article_id','=','article_tag.article_id')
            ->where('tag_id',$tag_id)
            ->where('is_del',Article::DEL_NO)
            ->where('is_release',Article::RECOMMEND_YES)
            ->with(['tags'=>function($query){
                $query->select(['tags.tag_id','tags.name']);
            }])
            ->with(['category'=>function($query){
                $query->select(['category_id','name']);
            }])
            ->with(['user'=>function($query){
                $query->select(['id','name','avatar']);
            }])
            ->orderByDesc('sort')
            ->select(DB::raw('articles.article_id,title,subtitle,readed_num,created_at,cover_img,type,category_id,comment_num,collect_num,user_id'))
            ->paginate(12);

        return [
            'articles'   =>  $articles->items(),
            'next_page'  =>  $articles->currentPage() + 1,
            'count'      =>  $articles->total()
        ];
    }


    public static function prevArticle(Article $article){
        return Article::query()->where('is_del',Article::DEL_NO)
            ->where('is_release',Article::RELEASE_YES)
            ->where('article_id','<',$article->article_id)
            ->select(DB::raw('article_id,title'))
            ->first();
    }

    public static function nextArticle(Article $article){
        return Article::query()->where('is_del',Article::DEL_NO)
            ->where('is_release',Article::RELEASE_YES)
            ->where('article_id','>',$article->article_id)
            ->select(DB::raw('article_id,title'))
            ->first();
    }

}