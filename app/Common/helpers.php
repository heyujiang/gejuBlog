<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/8/25
 * Time: 14:35
 */

if(!function_exists('jsonReturn')){
    /**
     * 请求返回参数
     * @param string $code
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonReturn($code = '200',$message = '',$data = []){
        if(!$data){
            $data = new stdClass();
        }
        $res  = [
            'code'      =>  $code,
            'message'   =>  $message,
            'data'      =>  $data
        ];
        return response()->json($res);
    }
}

if(!function_exists('jsonSuccess')){
    /**
     * 请求成功
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonSuccess($message = '操作成功',$data = []){
        return jsonReturn(200,$message,$data);
    }
}

if(!function_exists('jsonFail')){

    /**
     * 请求失败
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonFail($message = '操作失败',$data = []){
        return jsonReturn(400,$message,$data);
    }
}

if(!function_exists('unlinkImg')){
    /**
     * 从硬盘删除图片
     * @param $path
     */
    function unlinkImg($path){
        @unlink(storage_path('app').'/'.str_replace('storage','public',$path));
    }
}