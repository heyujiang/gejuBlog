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
use App\Models\comment;


class CommentService extends Serivce
{
    /**
     * 分页获取评论
     * @param array $attributes
     * @return CommentService
     */
    public function commentList(array $attributes = []) : CommentService
    {
        $query = comment::query();
        $comments = $query->paginate(15);
        return $this->setResponse([
            'comments'=>$comments->items(),
            'total'=>$comments->total(),
            'per_page'=>$comments->perPage(),
            'currentPage'=>$comments->currentPage()
        ]);
    }

    /**
     * 保存评论
     * @param array $attributes
     * @return CommentService
     */
    public function storeComment(array $attributes = []) : CommentService
    {
        $data = $attributes;
        if(!(new comment)->fill($data)->save())
            return $this->setResponse($data,Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 修改评论
     * @param Comment $comment
     * @param array $attributes
     * @return CommentService
     */
    public function updateComment(Comment $comment,array $attributes = []):CommentService
    {
        if(empty($attributes))
            return $this->setResponse('',Code::FAILED,'修改参数不可为空');
        $data = $attributes;
        if(!$comment->update($data))
            return $this->setResponse($data,Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 删除评论
     * @param Comment $comment
     * @return $this|CommentService
     * @throws \Exception
     */
    public function deleteComment(Comment $comment){
        if(!$comment->delete())
            return $this->setResponse($comment->toArray(),Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 批量删除
     * @param array $ids
     * @return CommentService
     */
    public function batchDestroy($ids = []) : CommentService
    {
        try{
            if(empty($ids))
                return $this->setResponse([],Code::FAILED,'请选择删除的项');
            if(is_array($ids)){
                if(!comment::query()->whereIn('comment_id',$ids)->delete())
                    return $this->setResponse([],Code::FAILED,Message::FAILED);
            }else{
                if(!comment::query()->where('comment_id',$ids)->delete())
                    return $this->setResponse([],Code::FAILED,Message::FAILED);
            }
            return $this;

        }catch (\Exception $exception){
            return $this->setResponse([],Code::FAILED,$exception->getMessage() . "|" .$exception->getLine());
        }
    }

}