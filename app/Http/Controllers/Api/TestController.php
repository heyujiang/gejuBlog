<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/10/10
 * Time: 18:02
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;


class TestController extends Controller
{
    public function index(){
        return $this->response();
    }
}