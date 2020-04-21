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
 *          * 文章相关
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Util;
use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    /**
     * 列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function get_list(Request $request)
    {
        $perPage = 15;
        $page = 1;
        if ($request->has('page')) {
            $page = $request->input('page');
            $page = $page <= 0 ? 1 : $page;
        }
        if ($request->has('limit')) {
            $perPage = $request->input('limit');
        }

        $count = Article::count();
        $query = Article::offset(($page - 1) * $perPage)->limit($perPage + 1);
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }
        $list = $query->get()->toArray();
        return $this->succeed(['total' => $count, 'items' => $list]);
    }

    /**
     * 详细内容
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function detail(Request $request)
    {
        $id = $request->input('id');
        $row = Article::where('id', $id)->first();
        return ! is_null($row) ? $this->succeed($row) : $this->failed();
    }

    /**
     * Pv list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function pv(Request $request)
    {
        return $this->succeed([
            ['key' => 'PC', 'pv' => 1024],
            ['key' => 'mobile', 'pv' => 1024],
            ['key' => 'ios', 'pv' => 1024],
            ['key' => 'android', 'pv' => 1024],
        ]);
    }

    /**
     * Create new（新建）.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function create(Request $request)
    {
        $data = $request->input('data');
        if (empty($data)) {
            return $this->faied();
        }
        $info = json_decode($data, true);
        $article = new Article();
        foreach ($info as $name => $value) {
            if ($name !== 'id') {
                $article->$name = $value;
            }
        }
        return $article->save() ? $this->succeed() : $this->faied();
    }

   /**
     * Update one.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function update(Request $request)
    {
        $data = $request->input('data');
        if (empty($data)) {
            return $this->faied();
        }
        $info = json_decode($data, true);
        $article = Article::where('id', $data['id']);
        if (is_null($article)) return $this->faied();
        foreach ($info as $name => $value) {
            'id' === $name ? : $article->$name = $value; // 简洁写法，可以对比下create
        }
        return $article->save() ? $this->succeed() : $this->faied();
    }

}
