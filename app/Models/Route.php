<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    /**
     * The attributes excluded from the route array.
     *
     * @var array
     */
    public static $routeHidden = [
        'children', 'root', 'created_at', 'updated_at'
    ];

    /**
     * The attributes boolean columns.
     *
     * @var array
     */
    public static $booleanColumns = [
        'alwaysShow', 'hidden', 'constant'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Fill a route array from db
     * @param array $all The routes all list.
     * @param array $info The one route info.
     * @param integer $times The function recursive times.
     * @return array
     **/
    public static function fillOne(&$all, &$info, &$times)
    {
        $times += 1;
        if ($times > 99) return; // Safe code for recursive.
        $r = [];
        foreach ($info as $k => $v) {
            if (! is_null($v) && ! in_array($k, static::$routeHidden)) {
                // 这只是一个比较简洁的写法，不建议初学者这样写
                $r[$k] = 'meta' === $k ? json_decode($v) : (in_array($k, static::$booleanColumns) ? $v !== 0 : $v);
            }
        }
       if (! empty($info['children'])) {
            $r['children'] = [];
            $children = explode(':', $info['children']);
            foreach ($children as $id) {
                array_push($r['children'], static::fillOne($all, $all[$id], $times)); // recursive self function.
            }
        }
        return $r;
    }

    /**
     * Role all routes array from db
     * @return array
     **/
    public static function getList()
    {
        $all = static::all()->toArray();
        $array = [];
        foreach ($all as $v) {
            $array[$v['id']] = $v;
        }
        $r = [];
        foreach ($array as $id => $info) {
            if ($info['root'] === 1) {
                $times = 0;
                $one = static::fill($array, $info, $times);
                array_push($r, $one);
            }
        }
        return $r;
    }

    /**
     * Role all routes arrays from db
     *
     * @return array
     **/
    public static function getLists()
    {
        $all = static::all()->toArray();
        $array = [];
        foreach ($all as $v) {
            $array[$v['id']] = $v;
        }
        $r = ['all' => [], 'constant' => [], 'async' => []];
        foreach ($array as $id => $info) {
            if (1 === $info['root']) {
                $times = 0;
                $one = static::fillOne($array, $info, $times);
                array_push($r['all'], $one);
                if (1 === $info['constant']) {
                    array_push($r['constant'], $one);
                } else {
                    array_push($r['async'], $one);
                }
            }
        }
        return $r;
    }

}
