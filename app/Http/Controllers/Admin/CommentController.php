<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Service\CommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.comment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comment.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $CommentService = new CommentService();
        return $CommentService->storeComment($data)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $Comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $Comment)
    {
        return view('admin.comment.edit',['Comment'=>$Comment]);
    }

    /**
     * Update the specified resource in storage
     * @param Request $request
     * @param Comment $Comment
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $Comment)
    {
        $data = $request->all();
        $CommentService = new  CommentService();
        return $CommentService->updateComment($Comment,$data)->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $Comment)
    {
        $CommentService = new  CommentService();
        return $CommentService->deleteComment($Comment)->response();
    }

    /**
     * 评论列表
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function CommentList(Request $request){
        $data = $request->all();
        $CommentService = new CommentService();
        return $CommentService->CommentList($data)->response();
    }

    /**
     * 批量删除
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destoryBatch(Request $request){
        $Comment_ids = $request->get('ids');
        if(count($Comment_ids) == 1){
            $Comment_ids = $Comment_ids[0];
        }
        $CommentService = new CommentService();
        return $CommentService->batchDestroy($Comment_ids)->response();
    }

    /**
 * 修改排序
 * @param Request $request
 * @param Comment $Comment
 * @return mixed
 */
    public function upSort(Request $request , Comment $Comment){
        $sort = $request->get('sort');
        $CommentService = new CommentService();
        return $CommentService->upSort($Comment,$sort)->response();
    }
}
