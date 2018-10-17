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
use App\Models\Tag;


class TagService extends Serivce
{
    /**
     * 分页获取标签
     * @param array $attributes
     * @return TagService
     */
    public function tagList(array $attributes = [])
    {
        $query = Tag::query();
        if(isset($attributes['name'])&&$attributes['name'])
            $query->where('name',$attributes['name']);
        $tags = $query->orderByDesc('sort')->get();
        return $this->setResponse(['tags'=>$tags]);
//        $tags = $query->orderByDesc('sort')->paginate(15);
//        return $this->setResponse([
//            'tags'=>$tags->items(),
//            'total'=>$tags->total(),
//            'per_page'=>$tags->perPage(),
//            'currentPage'=>$tags->currentPage()
//        ]);
    }

    /**
     * 保存标签
     * @param array $attributes
     * @return TagService
     */
    public function storeTag(array $attributes = []) : TagService
    {
        $data = $attributes;
        if(!(new Tag)->fill($data)->save())
            return $this->setResponse($data,Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 修改标签
     * @param Tag $tag
     * @param array $attributes
     * @return TagService
     */
    public function updateTag(Tag $tag,array $attributes = []):TagService
    {
        if(empty($attributes))
            return $this->setResponse('',Code::FAILED,'修改参数不可为空');
        $data = $attributes;
        if(!$tag->update($data))
            return $this->setResponse($data,Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 删除标签
     * @param Tag $tag
     * @return $this|TagService
     * @throws \Exception
     */
    public function deleteTag(Tag $tag){
        if(!$tag->delete())
            return $this->setResponse($tag->toArray(),Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 批量删除
     * @param array $ids
     * @return TagService
     */
    public function batchDestroy($ids = []) : TagService
    {
        try{
            if(empty($ids))
                return $this->setResponse([],Code::FAILED,'请选择删除的项');
            if(is_array($ids)){
                if(!Tag::query()->whereIn('tag_id',$ids)->delete())
                    return $this->setResponse([],Code::FAILED,Message::FAILED);
            }else{
                if(!Tag::query()->where('tag_id',$ids)->delete())
                    return $this->setResponse([],Code::FAILED,Message::FAILED);
            }
            return $this;

        }catch (\Exception $exception){
            return $this->setResponse([],Code::FAILED,$exception->getMessage() . "|" .$exception->getLine());
        }
    }

    /**
     * 标签排序
     * @param Tag $tag
     * @param $sort
     * @return TagService
     */
    public function upSort(Tag $tag,$sort) : TagService
    {
        try{
            if(!$sort)
                return $this->setResponse($tag,Code::FAILED,'排序数不可为空');
            $tag->sort = $sort;
            if(!$tag->save())
                return $this->setResponse($tag,Code::FAILED,'操作失败');
            return $this;
        }catch (\Exception $exception){
            return $this->setResponse($tag,Code::FAILED,$exception->getMessage() .'|'. $exception->getLine());
        }
    }

    /**
     * 获得所有标签
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function tags(){
        return Tag::query()->orderByDesc('sort')->get();
    }
}