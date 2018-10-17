<?php

namespace App\Http\Controllers\Admin;

use App\Component\Classes\Code;
use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Service\NavigationService;
use Illuminate\Http\Request;


class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigations = NavigationService::index();
        return view('admin.navigation.index',['navigations'=>$navigations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navigations = NavigationService::getParentNav();
        return view('admin.navigation.create',['navigations'=>$navigations]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $service = new NavigationService();
        return $service->createNav($data)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent_navigations = NavigationService::getParentNav();
        $navigation = NavigationService::getInfo($id);
        return view('admin.navigation.edit',['parent_navigations'=>$parent_navigations,'navigation'=>$navigation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $navigation = NavigationService::getInfo($id);
        $navigationService = new NavigationService();
        return $navigationService->update($navigation,$request->all())->response();
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $navigationService = new NavigationService();
        return $navigationService->destroy($id)->response();
    }

    /**
     * 修改排序
     * @param Request $request
     * @param Navigation $navigation
     * @return NavigationController|array|\Illuminate\Http\JsonResponse
     */
    public function upSort(Request $request,Navigation $navigation)
    {
        $data  = $request->all();
        if(!(isset($data['sort']) && $data['sort']))
            return $this->setResponse($navigation,Code::FAILED,'请填写排序号')->response();
        $navigationService = new NavigationService();
        return $navigationService->upNav($navigation,$data)->response();
    }
}
