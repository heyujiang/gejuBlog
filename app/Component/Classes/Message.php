<?php
/**
 * 请求返回信息
 * Created by PhpStorm.
 * User: 格局
 * Date: 2018/9/15
 * Time: 14:14
 */

namespace App\Component\Classes;


class Message
{
    const SUCCESS = '操作成功';

    const FAILED = '操作失败';

    const CREATE_SUCCESS = '创建成功';

    const CREATE_FAILED = '创建失败';

    const UPDATE_SUCCESS = '更新成功';

    const UPDATE_FAILED = '更新失败';

    const DELETE_SUCCESS = '删除成功';

    const DELETE_FAILED = '删除失败';

    const PLASE_CHOOSE_OPERATE_OPTION = "请选择操作项";
}