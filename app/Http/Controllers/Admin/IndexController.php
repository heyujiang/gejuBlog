<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/8/22
 * Time: 21:50
 */

namespace App\Http\Controllers\Admin;


use App\Events\TestEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    /**
     * 博客后台首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin.index.index');
    }

    /**
     * 博客控制台 （欢迎页）
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function console(){
        return view('admin.index.console');
    }
}