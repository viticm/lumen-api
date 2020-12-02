<?php
/**
 * LUMEN API ( https://github.com/viticm/lumen-api )
 * $Id GameController.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2020 viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm( viticm.ti@gmail.com )
 * @date 2020/07/14 19:36
 * @uses The game apis.
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Util;
use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerOpt;

class GameController extends Controller
{
    /**
     * The save all setting path.
     *
     * @var string
     */
    public static $settingPath = '/web/download/game/skynet-simple/';

    /**
     * Get server list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverList(Request $request)
    {
        $all = Server::all()->toArray();
        return $this->succeed($all);
    }

    /**
     * 详细内容
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverDetail(Request $request)
    {
        $id = $request->input('id');
        $row = Server::where('id', $id)->first();
        return ! is_null($row) ? $this->succeed($row) : $this->failed();
    }

    /**
     * 删除
     * @param number $id
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverDelete($id)
    {
        $row = Server::where('id', $id)->first();
        if (! is_null($row)) {
            $row->delete();
        }
        return $this->succeed();
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverSave(Request $request)
    {
        $one = null;
        $data = $request->all();
        if ($request->has('id')) {
            $one = Server::where('id', $request->input('id'))->first();
        }
        $one = $one ?? new Server();
        foreach ($data as $name => $value) {
            if ($name !== 'id') {
                $one->$name = $value;
            }
        }
        return $one->save() ? $this->succeed(['id' => $one->id]) : $this->failed();
    }

     /**
     * 查询某项配置是否存在
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverOptExistsOne(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        $r = 0;
        if (! is_null($key) && ! is_null($value)) {
            $row = ServerOpt::where($key, $value)->first();
            $r = is_null($row) ? 0 : 1;
        }
        return $this->succeed(['r' => $r]);
    }

    /**
     * Get server options list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverOptList(Request $request)
    {
        $all = ServerOpt::all()->toArray();
        return $this->succeed($all);
    }

    /**
     * 配置详细内容
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverOptDetail(Request $request)
    {
        $id = $request->input('id');
        $row = ServerOpt::where('id', $id)->first();
        return ! is_null($row) ? $this->succeed($row) : $this->failed();
    }

    /**
     * 配置删除
     * @param number $id
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverOptDelete($id)
    {
        $row = ServerOpt::where('id', $id)->first();
        if (! is_null($row)) {
            $row->delete();
        }
        return $this->succeed();
    }

    /**
     * 配置保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverOptSave(Request $request)
    {
        $one = null;
        $data = $request->all();
        if ($request->has('id')) {
            $one = ServerOpt::where('id', $request->input('id'))->first();
        }
        $one = $one ?? new ServerOpt();
        foreach ($data as $name => $value) {
            if ($name !== 'id') {
                $one->$name = $value;
            }
        }
        $this->serverOptDump($one);
        return $one->save() ? $this->succeed(['id' => $one->id]) : $this->failed();
    }

    /**
     * 导出服务器配置
     * @param array $data
     * @return void
     **/
    public function serverOptDump($data)
    {
        $array = $data->toArray();
        unset($array['created_at']);
        unset($array['updated_at']);
        $json = json_encode($data, true);
        $serverID = $data['server_id'];
        $serverType = $data['type'];
        $filename = $serverType . '_' . $serverID . '.json';
        if (! is_null($data['db'])) {
            $array['db'] = json_decode($data['db'], true);
        }
        if (! is_null($data['pcl'])) {
            $array['pcl'] = json_decode($data['pcl'], true);
        }
        if (! is_null($data['cluster'])) {
            $array['cluster'] = json_decode($data['cluster'], true);
        }
        if ($array['cluster']) {
            $clusterNode = array();
            if (file_exists(static::$settingPath)) {
                $clusterNode = json_decode(file_get_contents(static::$settingPath), true);
            }
            $clusterName = $array['cluster']['name'];
            $clusterAddr = $array['cluster']['addr'];
            $clusterNode[$clusterName] = $clusterAddr;
            file_put_contents(static::$settingPath . 'cluster.json', json_encode($clusterNode, JSON_PRETTY_PRINT));
        }
        $removeKeys = [];
        foreach ($array as $key => $value) {
            if (is_null($value)) {
                array_push($removeKeys, $key);
            }
        }
        foreach ($removeKeys as $key) {
            unset($array[$key]);
        }
        Log::info('The data:', $array);
        file_put_contents(static::$settingPath . $filename, json_encode($array, JSON_PRETTY_PRINT));
    }

    /**
     * User create.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function userCreate(Request $request)
    {
        return $this->succeed();
    }

    /**
     * User login.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function userLogin(Request $request)
    {
        $sign_key = 'O6YuI4eS@l!N9WUs';
        $data = $request->input('data');
        $check_sign = $request->input('sign');
        if (md5($data . $sign_key) !== $check_sign) {
            return $this->failed('sign check failed', 1);
        }
        $info = json_decode($data, true);
        
        Log::info('The data:', $info);
        $data = array(
            'status' => 1,
            'id' => $info['user_name'],
            'special' => 1,
            'channel' => 100,
            'model' => 1
        );
        return $this->succeed(['user_info' => $data]);
    }

}
