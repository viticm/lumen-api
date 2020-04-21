<?php

/**
 * RoleController.php
 * PHP version 7
 * @category    PHP
 * @package     lumen
 * @author      leafly
 * @copyright   leafly
 * @uses        The role controller class.
 **/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use illuminate\support\Str;
use illuminate\support\Arr;
use App\Util;
use App\Models\Role;
use App\Models\Route;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
 
    /**
     * Fill a route array from db
     * @param array $all The routes all list.
     * @param array $info The one route info.
     * @param integer $times The function recursive times.
     * @return array
     **/
    public static function routeFill(&$all, &$info, &$times)
    {
        $times += 1;
        if ($times > 99) return; // Safe code for recursive.
        $r = [];
        foreach ($info as $k => $v) {
            if (!is_null($v) && !in_array($k, static::$routeHidden)) {
                // 这只是一个比较简洁的写法，不建议初学者这样写
                $r[$k] = 'meta' === $k ? json_decode($v) : ('hidden' == $k || 'alwaysShow' == $k ? $v !== 0 : $v);
            }
        }
       if (!empty($info['children'])) {
            $r['children'] = [];
            $children = explode(':', $info['children']);
            foreach ($children as $id) {
                array_push($r['children'], static::routeFill($all, $all[$id], $times)); // recursive self function.
            }
        }
        return $r;
    }

     /**
     * Role all routes array from db
     * @return array
     **/
    public static function routes_array()
    {
        $all = Route::all()->toArray();
        $array = [];
        foreach ($all as $v) {
            $array[$v['id']] = $v;
        }
        $r = [];
        foreach ($array as $id => $info) {
            if ($info['root'] === 1) {
                $times = 0;
                $one = static::routeFill($array, $info, $times);
                array_push($r, $one);
            }
        }
        return $r;
    }

    /**
     * Role all routes
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function routes(Request $request)
    {
        $all = static::routes_array();
        return $this->succeed($all);
    }

     /**
     * Role all.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function roles(Request $request)
    {
        $all = Role::all()->toArray();
        $routes = static::routes_array();
        foreach ($all as $key => $info) {
            // Log::info("routes: " . $info['routes'] . ' ' . (empty($info['routes']) ? 0 : 1));
            if (!empty($info['routes'])) {
                $children_ids = explode(':', $info['routes']);
                // Log::info('routes: ', $children_ids);
                $all[$key]['routes'] = array_values(array_filter($routes, function($v, $k) use ($children_ids) {
                    return in_array(strval($v['id']), $children_ids);
                }, ARRAY_FILTER_USE_BOTH));
                // Log::info('json: '. json_encode($all[$key]['routes']));
            }
        }
        return $this->succeed($all);
    }

    /**
     * Role add.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function add(Request $request)
    {
        $data = $request->input('data');
        $array = json_decode($data, true);
        $key = $array['key'];
        $name = $array['name'];
        if (empty($name)) return $this->failed();
        $key = empty($key) ? $name : $key;
        $row = Role::where('key', $key)->orWhere('name', $name)->first();
        if (! is_null($row)) return $this->failed('The role is exists');
        $description = $array['description'];
        $role = new Role();
        $role->key = $key;
        $role->name = $name;
        $role->description = $description;

        //Get the route ids.
        $routes_ids = Util::arrayPluck($array['routes'], 'id');
        $role->routes = implode(':', $routes_ids);

        return $role->save() ? $this->succeed() : $this->failed();
    }

    /**
     * Role update.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function update(Request $request, $id)
    {
        $data = $request->input('data');
        $array = json_decode($data, true);
        $key = $array['key'];
        $name = $array['name'];
        if (empty($key)) return $this->failed();
        $row = Role::where('key', $key)->first();
        if (is_null($row)) return $this->failed();
        $row->name = $name;
        
        //Get the route ids.
        $routes_ids = Util::arrayPluck($array['routes'], 'id');
        $row->routes = implode(':', $routes_ids);

        return $row->save() ? $this->succeed() : $this->failed();
    }

    /**
     * Role delete.
     * @param string $id The role key name.
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function delete($id)
    {
        $row = Role::where('key', $id)->first();
        if ($row) $row->delete();
        return $this->succeed();
    }

    /**
     * The attributes excluded from the route array.
     *
     * @var array
     */
    public static $routeHidden = [
        'children', 'root', 'created_at', 'updated_at'
    ];


}
