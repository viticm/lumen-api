<?php
/**
 * LUMEN API ( https://github.com/viticm/lumen-api )
 * $Id RouteController.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2014- viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm<viticm.ti@gmail.com>
 * @date 2020/05/09 11:16
 * @uses The route controller.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Util;
use App\Models\Route;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    /**
     * The save route json file path.
     *
     * @var array
     */
    public static $jsonFile = 'routes.json';

    /**
     * The save route js file path.
     *
     * @var array
     */
    public static $jsFile = 'routes.js';

    /**
     * The not import components.
     *
     * @var array
     */
    public static $notImportComponents = [
        'Layout'
    ];


    /**
     * 路由表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function table(Request $request)
    {
        $all = Route::all()->toArray();
        return $this->succeed($all);
    }

     /**
     * 转换JS代码（路由中用到的）
     * @return array $array The source array.
     * @param int $depth
     **/
    public static function convertJS(&$array, $depth = INF)
    {
        if (! is_array($array)) return;
        unset($array['constant']);
        foreach ($array as $k => &$v) {
            if (! is_array($v)) {
                if ('component' === $k && ! in_array($v, static::$notImportComponents)) {
                    $v = "() => import('@/".$v."')";
                }
            } elseif ($depth >= 1) {
                static::convertJS($v, $depth - 1);
            }
        }
    }

     /**
     * 导出路由表
     **/
    public static function dump()
    {
        $lists = Route::getLists();
        list($all, $constant, $async) = [ $lists['all'], $lists['constant'], $lists['async'] ];
        static::convertJS($constant);
        static::convertJS($async);
        Storage::put(static::$jsonFile, json_encode($all, JSON_PRETTY_PRINT));

        Storage::put(static::$jsFile, '/* This file is generate by lumen api(leafly) */'."\n");
        Storage::append(static::$jsFile, 'import Layout from \'@/layout\''."\n");

        //Constant.
        $constantStr = preg_replace('/component: \'(.*)\'/', 'component: $1', Util::arrayToJS($constant));
        Storage::append(static::$jsFile, '/**');
        Storage::append(static::$jsFile, ' * constantRoutes');
        Storage::append(static::$jsFile, ' * a base page that does not have permission requirements');
        Storage::append(static::$jsFile, ' * all roles can be accessed');
        Storage::append(static::$jsFile, ' */');
        Storage::append(static::$jsFile, 'export const constantRoutes = '.$constantStr."\n");

        //Async.
        $asyncStr = preg_replace('/component: \'(.*)\'/', 'component: $1', Util::arrayToJS($async));
        Storage::append(static::$jsFile, '/**');
        Storage::append(static::$jsFile, ' * asyncRoutes');
        Storage::append(static::$jsFile, ' * the routes that need to be dynamically loaded based on user roles');
        Storage::append(static::$jsFile, ' */');
        Storage::append(static::$jsFile, 'export const asyncRoutes = '.$asyncStr);
    }

}
