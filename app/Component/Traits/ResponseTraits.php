<?php
/**
 * 全局响应traits
 * Created by PhpStorm.
 * User: 格局
 * Date: 2018/9/15
 * Time: 14:02
 */

namespace App\Component\Traits;


use App\Component\Classes\Code;
use App\Component\Classes\Message;

trait ResponseTraits{
    protected $code = Code::SUCCESS;

    protected $message = Message::SUCCESS;

    protected $resposenData = [];

    public function setResponse($data , $code = Code::SUCCESS ,$message = Message::SUCCESS){
        $this->code = $code;

        $this->message = $message;

        $this->resposenData = $data;

        return $this;
    }

    /**
     * @param bool $inApp  如果在app中返回无需josn 此时第二参数有效
     * @param bool $onlyData  如果只返回数据
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function response($inApp = false, $onlyData = false){
        $response = [
            'code'      =>   $this->code,
            'message'   =>   $this->message,
            'data'      =>   $this->resposenData
        ];

        if($inApp){
            if($onlyData)
                return $this->resposenData;
            return $response;
        }

        return response()->json($response);
    }

}
