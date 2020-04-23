<?php
/**
 * PLAIN FRAMEWORK ( https://github.com/viticm/lumen-api )
 * $Id ArticleController.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2014- viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm<viticm.ti@gmail.com>
 * @date 2020/04/21 15:38
 * @uses Article controller class.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Util;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    /**
     * Get the list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function get_list(Request $request)
    {
        $list = Transaction::all()->toArray();
        $count = count($list);
        return $this->succeed(['total' => $count, 'items' => $list]);
    }

    /**
     * Test user list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function users(Request $request)
    {
        $names = [
            ['name' => '111'],
            ['name' => '222'],
            ['name' => '333'],
            ['name' => '444'],
            ['name' => '555'],
            ['name' => '666'],
        ];
        $search_name = $request->input('name');
        $r = $names;
        if (! empty($search_name)) {
            $r = array_filter($names, function($value) use ($search_name) {
                return strpos($value['name'], $search_name) !== false;
            });
        }
        return $this->succeed(['items' => $r]);
    }


}
