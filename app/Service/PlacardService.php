<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/9/16
 * Time: 11:29
 */

namespace App\Service;


use App\Component\Classes\Code;
use App\Component\Classes\Message;
use App\models\Placard;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Email;

class PlacardService extends Serivce
{
    /**
     * 公告数据列表
     * @param array $where
     * @return PlacardService
     */
    public function placardList(array $where = []): PlacardService
    {
        try {
            $query = Placard::query()->where('is_del', Placard::DELETE_STATUS_NO);
            if (isset($where['title']) && $where['title']) {
                $query->where('title','like',"%{$where['title']}%");
            }
            $placards = $query->orderBy('is_show')
                ->orderByDesc('sort')
                ->paginate(15);

            return $this->setResponse([
                'placards' => $placards->items(),
                'total' => $placards->total(),
                'per_page' => $placards->perPage(),
                'currentPage' => $placards->currentPage()
            ]);
        } catch (\Exception $exception) {
            return $this->setResponse([], Code::FAILED, $exception->getMessage() . '|' . $exception->getLine());
        }

    }

    /**
     * 获得前台要显示的公告
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTopList()
    {
        return Placard::query()
            ->where('is_sel', 2)
            ->where('is_top', 2)
            ->orderByDesc('sort')->get();
    }

    /**
     * 创建新的公告
     * @param array $attributes
     * @return $this
     */
    public function createPlacard(array $attributes = []): PlacardService
    {
        if(isset($attributes['is_show'])){
            $attributes['is_show'] = Placard::SHOW_STATUS_YES;
        }else{
            $attributes['is_show'] = Placard::SHOW_STATUS_NO;
        }
        if (!(new Placard())->fill($attributes)->save()) {
            $this->setResponse([], Code::FAILED, Message::FAILED);
        }
        return $this;
    }

    /**
     * 更新公告
     *
     * @param array $attributes
     * @return object
     */
    public function updatePlacard(array $attributes, $placard): PlacardService
    {
        try {
            if(!(isset($attributes['is_show']) && $attributes['is_show']))
                $attributes['is_show'] = Placard::SHOW_STATUS_NO;
            if (!$placard->update($attributes))
                return $this->setResponse($attributes, Code::FAILED, '保存失败');
            return $this;
        } catch (\Exception $exception) {
            return $this->setResponse([], Code::FAILED, $exception->getMessage() . '|' . $exception->getLine());
        }
    }

    /**
     * 删除公告
     * @param $placard
     * @return $this
     */
    public function destory($placard): PlacardService
    {
        if (!$placard->destory())
            $this->setResponse([], Code::FAILED, Message::FAILED);
        return $this;
    }

    /**
     * 批量删除公告
     * @param $ids
     * @return $this
     */
    public function destoryBatch(array $ids = []): PlacardService
    {
        if (empty($ids))
            $this->setResponse([], Code::FAILED, Message::FAILED);
        if (!Placard::whereIn('placard_id', $ids))
            $this->setResponse([], Code::FAILED, Message::FAILED);
        return $this;
    }

    /**
     * 修改公告状态 是否显示
     * @param Placard $placard
     * @return PlacardService
     */
    public function upPlacardShow(Placard $placard): PlacardService
    {
        $update = ['is_show'=>Placard::SHOW_STATUS_NO];
        if ($placard->is_show == Placard::SHOW_STATUS_NO) {
            $update['is_show'] = Placard::SHOW_STATUS_YES;
        }
        if (!$placard->update($update))
            return $this->setResponse([], Code::FAILED, Message::FAILED);
        return $this;
    }

    /**
     * 删除公告
     * @param Placard $placard
     * @return PlacardService
     */
    public function destroy(Placard $placard): PlacardService
    {
        try {
            if (!$placard->delete())
                return $this->setResponse($placard, Code::FAILED, '删除失败');
            return $this;
        } catch (\Exception $exception) {
            return $this->setResponse([], Code::FAILED, $exception->getMessage() . '|' . $exception->getLine());
        }
    }

    /**
     * 批量删除公告
     * @param array $placard_ids
     * @return $this|PlacardService
     */
    public function batchDestroy($placard_ids = [])
    {
        try {
            if (empty($placard_ids))
                return $this->setResponse([], Code::FAILED, '请选择要删除的公告');
            if (is_array($placard_ids)) {
                if (!Placard::query()->whereIn('placard_id', $placard_ids)->delete())
                    return $this->setResponse([], Code::FAILED, '删除失败');
            } else {
                if (!Placard::query()->where('placard_id', $placard_ids)->delete())
                    return $this->setResponse([], Code::FAILED, '删除失败');
            }
            return $this;
        } catch (\Exception $exception) {
            return $this->setResponse($placard_ids, Code::FAILED, $exception->getMessage() . '|' . $exception->getLine());
        }
    }


    public function upSort(Placard $placard,$sort = 0): PlacardService
    {
        if(!$sort)
            return $this->setResponse($placard,Code::FAILED,'排序数不可为空');
        $placard->sort = $sort;
        if(!$placard->save())
            return $this->setResponse($placard,Code::FAILED,'操作失败');
        return $this;
    }


    /**
     * 首页公告
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function placards(){
        return Placard::query()
            ->where('is_del',Placard::DELETE_STATUS_NO)
            ->where('is_show',Placard::SHOW_STATUS_YES)
            ->select(DB::raw('placard_id,title'))
            ->limit(3)
            ->get();
    }
}
