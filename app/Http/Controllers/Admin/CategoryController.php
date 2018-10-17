<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = CategoryService::index();
        return view('admin.category.index',['categorys'=>$categorys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategorys = CategoryService::getParentCate();
        return view('admin.category.create',['parentCategorys'=>$parentCategorys]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $categoryService = new CategoryService();
        return $categoryService->storeCategory($data)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategorys = CategoryService::getParentCate();
        return view('admin.category.edit',['category'=>$category,'parentCategorys'=>$parentCategorys]);
    }

    /**
     * Update the specified resource in storage
     * @param Request $request
     * @param Category $category
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $categoryService = new  CategoryService();
        return $categoryService->updateCategory($category,$data)->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $categoryService = new  CategoryService();
        return $categoryService->deleteCategory($category)->response();
    }

    /**
     * 标签列表
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function CategoryList(Request $request){
        $post = $request->getContent();
        $data = json_decode($post,true);
        $categoryService = new CategoryService();
        return $categoryService->CategoryList($data)->response();
    }

    /**
     * 批量删除
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destoryBatch(Request $request){
        $post = $request->getContent();
        $data = json_decode($post,true);
        $categoryService = new CategoryService();
        return $categoryService->CategoryList($data['id'])->response();

    }

    /**
     * 修改排序
     * @param Request $request
     * @param Category $category
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upSort(Request $request , Category $category){
        $sort = $request->get('sort');
        $categoryService = new CategoryService();
        return $categoryService->upSort($category,$sort)->response();
    }
}
