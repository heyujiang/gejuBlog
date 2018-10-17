<?php

namespace App\Http\Controllers\Admin;

use App\Component\Classes\Code;
use App\models\Placard;
use App\Service\PlacardService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.placard.index',['show_status'=>Placard::SHOW_STATUS]);
    }

    /**
     * 公告数据
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function placardList(Request $request){
        $post = $request->all();
        $placardService = new PlacardService();
        return $placardService->placardList($post)->response();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.placard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $post = $request->all();
        $placardService = new PlacardService();
        return $placardService->createPlacard($post)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Placard  $placard
     * @return \Illuminate\Http\Response
     */
    public function show(Placard $placard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Placard  $placard
     * @return \Illuminate\Http\Response
     */
    public function edit(Placard $placard)
    {
        return view('admin.placard.edit',['placard'=>$placard]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Placard $placard
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Placard $placard)
    {
        $post = $request->all();
        $placardService = new PlacardService();
        return $placardService->updatePlacard($post,$placard)->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Placard $placard
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy(Placard $placard)
    {
        $placardService = new PlacardService();
        return $placardService->destroy($placard)->response();
    }

    /**
     * 批量删除
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function batchDel(Request $request){
        $placard_ids = $request->get('ids');
        if(count($placard_ids) == 1){
            $placard_ids = $placard_ids[0];
        }
        $placardService = new PlacardService();
        return $placardService->batchDestroy($placard_ids)->response();
    }

    /**
     * 隐藏 | 显示 公告
     * @param Placard $placard
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upShowStatus(Placard $placard){
        $placardService = new PlacardService();
        return $placardService->upPlacardShow($placard)->response();
    }

    /**
     * @param Placard $placard
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upSort(Request $request,Placard $placard){
        $sort = $request->get('sort');
        $placardService = new PlacardService();
        return $placardService->upSort($placard,$sort)->response();
    }


}
