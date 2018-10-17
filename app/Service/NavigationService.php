<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/8/22
 * Time: 18:24
 */

namespace App\Service;


use App\Component\Classes\Code;
use App\Component\Classes\Message;
use App\Models\Navigation;
use Illuminate\Support\Facades\DB;


class NavigationService extends Serivce
{
    /**
     * 获得一个导航的详细信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public static function getInfo($id){
        return Navigation::query()->where('navigation_id',$id)->first();
    }

    /**
     * 博客前台导航数据
     * @return array
     */
    public static function blogIndex(){
        $navigationList = Navigation::query()
            ->where('is_del',Navigation::DEL_STATUS_NO)
            ->orderByDesc('sort')
            ->get();

        $navigationGroupByPid = collect($navigationList)->groupBy('navigation_pid')->toArray()??[];
        if(!empty($navigationGroupByPid)){
            foreach ($navigationGroupByPid[0] as &$parentNavgation){
                $parentNavgation['children'] = $navigationGroupByPid[$parentNavgation['navigation_id']]??[];
            }
            return $navigationGroupByPid[0];
        }
       return [];


    }

    /**
     * 获得导航列表
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function index()
    {
        $navigationList = Navigation::query()
            ->where('is_del',Navigation::DEL_STATUS_NO)
            ->orderByDesc('sort')
            ->get();

        $navigationGroupByPid = collect($navigationList)->groupBy('navigation_pid')->toArray()??[];

        $returnNavigations = [];

        if($navigationGroupByPid){
            foreach ($navigationGroupByPid[0] as $parentNavgation){
                $returnNavigations[] = $parentNavgation;
                $returnNavigations = array_merge($returnNavigations,$navigationGroupByPid[$parentNavgation['navigation_id']]??[]);
            }
        }

        return $returnNavigations;
    }

    /**
     * 获得所有可以作为父导航的一级导航
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getParentNav(){
        return Navigation::query()
            ->where('navigation_pid',0)
            ->where('is_del',Navigation::DEL_STATUS_NO)
            ->get(['navigation_id','name']);
    }

    /**
     * 创建新的导航
     * @param array $attributes
     * @return $this
     */
    public function createNav(array $attributes = []){
        $navigation = new Navigation();
        if(!$navigation->fill($attributes)->save()){
            $this->setResponse([],Code::FAILED,Message::FAILED);
        }
        return $this;
    }


    /**
     * 删除
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        if(empty($id))
            return jsonReturn('400','导航id不可为空');
        //导航信息
        $navigationInfo = self::getInfo($id);

        if($navigationInfo->navigation_pid == 0 && Navigation::query()->where('navigation_pid',$navigationInfo->navigation_id)->first())
            return $this->setResponse([],Code::FAILED,'该导航还有子导航,不可删除');
        if(!$navigationInfo->update(['is_del'=>Navigation::DEL_STATUS_YES]))  //修改删除状态为已经删除
            return $this->setResponse([],Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 编辑导航
     * @param $navigation
     * @param array $attributes
     * @return $this
     */
    public function update($navigation,array $attributes = []){
        if(!$navigation->update($attributes))
            $this->setResponse([],Code::FAILED,Message::FAILED);
        return $this;
    }

    /**
     * 修改导航项
     * @param Navigation $navigation
     * @param array $attributes
     * @return NavigationService
     */
    public function upNav(Navigation $navigation,array $attributes = [])
    {
        if(empty($attributes))
            return $this->setResponse($navigation,Code::FAILED,'确认修改项');
        if(isset($attributes['sort']) && $attributes['sort'])
            $update['sort'] = $attributes['sort'];
        if(!$navigation->update($update))
            return $this->setResponse($navigation,Code::FAILED,'操作失败');
        return $this->setResponse([],Code::SUCCESS,'操作成功');
    }
}