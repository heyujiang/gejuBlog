<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/10/1
 * Time: 22:20
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class SystemController  extends Controller
{
    /**
     * 解锁页面
     */
    public function unlock(){
        return view('admin.system.unlock');
    }

    /**
     * 控制面板
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function controlPanel()
    {
        return view('admin.system.control_panel');
    }
}