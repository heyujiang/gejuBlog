<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/9/24
 * Time: 22:21
 */

namespace App\Service\Tools;


use App\Component\Classes\UploadLoad;
use App\Service\Serivce;

class ToolsService extends Serivce
{
    public static function uploadImage($images,$up_type = 1){
        $load = UploadLoad::UPLOAD[$up_type];
        $imgName = md5(time() + rand(1,100)).'.'.$images->getClientOriginalExtension();
        $path = $images->storeAs('/'.$load.'/'.date('Y-m-d'),$imgName,'public');
        if($path)
            return 'storage/'.$path;
        return false;
    }
}