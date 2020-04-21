<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    /**
    * 返回成功
    * @param array $data 返回的数据
    * @param string $message 返回的消息
    * @param int $code 返回的标志码
    * @return \Illuminate\Http\JsonResponse
    **/
    public function succeed($data = [], $message = "successd", $code = 20000)
    {
         return response()->json(
            ['message' => $message, 'code' => $code, 'data'=> $data]);
    }

    /**
    * 返回失败
    * @param string $message 返回的消息 
    * @param int $code 返回的错误码
    * @return \Illuminate\Http\JsonResponse
    **/
    public function faied($message = "failed", $code = -1)
    {
        return response()->json(['message' => $message, 'code' => $code]);
    }

}
