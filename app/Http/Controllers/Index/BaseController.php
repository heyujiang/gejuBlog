<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/8/22
 * Time: 17:42
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Service\NavigationService;
use Illuminate\Support\Facades\View;



class BaseController  extends Controller
{
    public function __construct()
    {
        //加载导航信息
        $navigations = NavigationService::blogIndex();
        View::share('navigations',$navigations);
    }
}
