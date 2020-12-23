<?php
/**
 * LUMEN API ( https://github.com/viticm/lumen-api )
 * $Id SomeoneController.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2020 viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm( viticm.ti@gmail.com )
 * @date 2020/12/23 14:07
 * @uses Someone apis.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Someone;
use App\Http\Controllers\Controller;
use App\Models\One;

class SomeoneController extends Controller
{

    public static $toMail = '903176912@qq.com';

    /**
     * Send data to mail.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function sendMail(Request $request)
    {
        $data = $request->all();
        $one = new One();
        foreach ($data as $name => $value) {
            if ($name !== 'id') {
                $one->$name = $value;
            }
        }
		$one->sex = 0 == $one->sex ? '女' : '男';
        Mail::to(self::$toMail)
            ->send(new Someone($one));
        return $this->succeed();
    }

}
