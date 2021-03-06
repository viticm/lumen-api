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
     * Role all routes
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function routes(Request $request)
    {
        $all = Route::getList();
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
        // $routes = Route::getList();
        foreach ($all as $key => $info) {
            // Log::info("routes: " . $info['routes'] . ' ' . (empty($info['routes']) ? 0 : 1));
            if (!empty($info['routes'])) {
                $children_ids = explode(':', $info['routes']);
                foreach ($children_ids as &$id) {
                    $id = (int)$id;
                }
                // Log::info('routes: ', $children_ids);
                $all[$key]['routes'] = $children_ids; /*array_values(array_filter($routes, function($v, $k) use ($children_ids) {
                    return in_array(strval($v['id']), $children_ids);
                }, ARRAY_FILTER_USE_BOTH));*/
                // Log::info('json: '. json_encode($all[$key]['routes']));
            }
        }
        return $this->succeed($all);
    }

    /**
     * Role add.
     * Add and update can use one function as save(see RouteConntroller::save).
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

        // Get the route ids.
        // $routes_ids = Util::arrayPluck($array['routes'], 'id');
        $role->routes = $array['routes']; //implode(':', $routes_ids);

        return $role->save() ? $this->succeed(['id' => $role->id]) : $this->failed();
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
        $row = Role::where('id', $id)->first();
        if (is_null($row)) return $this->failed();
        foreach ($array as $k => $v) {
            $row->$k = $v;
        }
        return $row->save() ? $this->succeed() : $this->failed();
    }

    /**
     * Role delete.
     * @param string $id The id.
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function delete($id)
    {
        $row = Role::where('id', $id)->first();
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
