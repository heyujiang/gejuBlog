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
use App\Models\Category;
use Illuminate\Support\Facades\DB;



class CategoryService extends Serivce
{
    public static function index(){
        $categoryList = Category::query()
            ->orderByDesc('sort')
            ->get();

        $categoryGroupByPid = collect($categoryList)->groupBy('p_id')->toArray()??[];

        $returnCategorys = [];

        if($categoryGroupByPid){
            foreach ($categoryGroupByPid[0] as $parentCategory){
                $returnCategorys[] = $parentCategory;
                $returnCategorys = array_merge($returnCategorys,$categoryGroupByPid[$parentCategory['category_id']]??[]);
            }
        }

        return $returnCategorys;
    }

    /**
     * 获得所有可以作为父导航的一级导航
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getParentCate(){
        return Category::query()
            ->where('p_id',0)
            ->get(['category_id','name']);
    }


    /**
     * 分页获取标签
     * @param array $attributes
     * @return CategoryService
     */
    public function CategoryList(array $attributes = []) : CategoryService
    {
        $query = Category::query();
        $categorys = $query->paginate(15);
        return $this->setResponse([
            'placards'=>$categorys->items(),
            'total'=>$categorys->total(),
            'per_page'=>$categorys->perPage(),
            'currentPage'=>$categorys->currentPage()
        ]);
    }

    /**
     * 保存标签
     * @param array $attributes
     * @return CategoryService
     */
    public function storeCategory(array $attributes = []) : CategoryService
    {
        $data = $attributes;
        if(!(new Category())->fill($data)->save())
            return $this->setResponse($data,Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 修改标签
     * @param Category $category
     * @param array $attributes
     * @return CategoryService
     */
    public function updateCategory(Category $category,array $attributes = []):CategoryService
    {
        if(empty($attributes))
            return $this->setResponse('',Code::FAILED,'修改参数不可为空');
        $data = $attributes;
        if(!$category->update($data))
            return $this->setResponse($data,Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 删除标签
     * @param Category $category
     * @return $this|CategoryService
     * @throws \Exception
     */
    public function deleteCategory(Category $category){
        if($category->p_id == 0 && Category::query()->where('p_id',$category->category_id)->first())
            return $this->setResponse($category->toArray(),Code::FAILED,'该分类有子分类不可删除');
        if(!$category->delete())
            return $this->setResponse($category->toArray(),Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 批量删除
     * @param array $ids
     * @return CategoryService
     */
    public function destoryBatch(array $ids = []) : CategoryService {
        if(empty($ids))
            $this->setResponse([],Code::FAILED,Message::FAILED);
        if(!Category::whereIn('Category_id',$ids))
            $this->setResponse([],Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 标签排序
     * @param Category $category
     * @param $sort
     * @return CategoryService
     */
    public function upSort(Category $category,$sort) : CategoryService
    {
        try{
            if(!$sort)
                return $this->setResponse($category,Code::FAILED,'排序数不可为空');
            $category->sort = $sort;
            if(!$category->save())
                return $this->setResponse($category,Code::FAILED,'操作失败');
            return $this;
        }catch (\Exception $exception){
            return $this->setResponse($category,Code::FAILED,$exception->getMessage() .'|'. $exception->getLine());
        }
    }
}