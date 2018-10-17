<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Service\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $tagService = new TagService();
        return $tagService->storeTag($data)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit',['tag'=>$tag]);
    }

    /**
     * Update the specified resource in storage
     * @param Request $request
     * @param Tag $tag
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->all();
        $tagService = new  TagService();
        return $tagService->updateTag($tag,$data)->response();
    }

    /**
     * Remove the specified resource from storage.
     * @param Tag $tag
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tagService = new  TagService();
        return $tagService->deleteTag($tag)->response();
    }

    /**
     * 标签列表
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function tagList(Request $request){
        $data = $request->all();
        $tagService = new TagService();
        return $tagService->tagList($data)->response();
    }

    /**
     * 批量删除
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destoryBatch(Request $request){
        $tag_ids = $request->get('ids');
        if(count($tag_ids) == 1){
            $tag_ids = $tag_ids[0];
        }
        $tagService = new TagService();
        return $tagService->batchDestroy($tag_ids)->response();
    }

    /**
     * 修改排序
     * @param Request $request
     * @param Tag $tag
     * @return mixed
     */
    public function upSort(Request $request , Tag $tag){
        $sort = $request->get('sort');
        $tagService = new TagService();
        return $tagService->upSort($tag,$sort)->response();
    }

}
