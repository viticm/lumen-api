<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    Log::info("Test log 1..................." . URL::current());
    return $router->app->version();
});

$router->group(['prefix' => 'lumen-api'], function () use ($router) {

    // $rts = $router->getRoutes();
    // Log::info("Test log..................." , $rts);

    $router->get('user', function(){
        return 'Lumen api for user';
    });

    $router->group(['prefix' => 'account/{id}'], function() use ($router) {
        $router->get('', function($id) {
            return 'account: ' . $id;
        });
        $router->get('ccc', function($id) {
            return 'account id: ' . $id;
        });
    });

    $router->get('acc/{id}', function($id) use ($router) {
        return 'acc: ' . $id;
    });

    // The game apis.
    $router->get('game/server/list', 'GameController@serverList');
    $router->get('game/server/detail', 'GameController@serverDetail');
    $router->post('game/server/save', 'GameController@serverSave');
    $router->delete('game/server/delete/{id}', 'GameController@serverDelete');
    $router->get('game/serveropt/list', 'GameController@serverOptList');
    $router->get('game/serveropt/detail', 'GameController@serverOptDetail');
    $router->get('game/serveropt/exists-one', 'GameController@serverOptExistsOne');
    $router->post('game/serveropt/save', 'GameController@serverOptSave');
    $router->delete('game/serveropt/delete/{id}', 'GameController@serverOptDelete');
    $router->post('game/user/create', 'GameController@userCreate');
    $router->post('game/user/login', 'GameController@userLogin');
    $router->post('other/someone/save', 'SomeoneController@sendMail');

    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->get('/', function () {

        });

        // User operate.
        $router->get('user/profile', function () {
            return 'user/profile';
        });
        $router->get('user/info', 'AuthController@info');
        $router->post('user/logout', 'AuthController@signout');

        // Role operate.
        $router->get('routelist', 'RoleController@routes');
        $router->get('roles', 'RoleController@roles');
        $router->delete('role/{id}', 'RoleController@delete');
        $router->put('role/{id}', 'RoleController@update');
        $router->post('role', 'RoleController@add');

        // Route operate.
        $router->get('route/table/list', 'RouteController@table');
        $router->post('route/table/save', 'RouteController@save');
        $router->delete('route/table/delete/{id}', 'RouteController@delete');

        // Article operate.
        $router->get('article/list', 'ArticleController@get_list');
        $router->get('article/detail', 'ArticleController@detail');
        $router->get('article/pv', 'ArticleController@pv');
        $router->post('article/create', 'ArticleController@create');
        $router->post('article/update', 'ArticleController@update');
        $router->delete('article/delete/{id}', 'ArticleController@delete');

        //Search operate.
        $router->get('search/user', 'TransactionController@users');
        $router->get('transaction/list', 'TransactionController@get_list');

    });

    $router->get('test/{value}', 'TestController@print');

    $router->get('response', function() use ($router) {
        return response()->json(['name' => 'Abigail', 'state' => 'CA',
                            'arr' => [1, 3, 5, "xxx"]]);
    });

    // Test.
    $router->get('article_list', 'ArticleController@get_list');

    // Account operate.
    $router->post('signup', 'AuthController@signup');
    $router->post('signin', 'AuthController@signin');
    $router->post('user/login', 'AuthController@signin');
    $router->post('user/login1', function() {
        Log::info("xxx user login=========================================");
        return 'xxxxxxxxxxxxxxxxxxx';
    });


    // Faith.
    $router->group(['prefix' => 'faith'], function () use ($router) {

        $router->group(['prefix' => 'game'], function () use ($router) {
            $router->post('register', 'FaithController@register');
            $router->post('login', 'FaithController@login');
            $router->post('onekey_login', 'FaithController@onekeyLogin');
            $router->post('guest_login', 'FaithController@guestLogin');
            $router->post('get_region_list', 'FaithController@regionList');
            $router->post('get_server_list', 'FaithController@serverList');
            $router->post('get_role_list', 'FaithController@roleList');
            $router->post('login_point', 'FaithController@loginPoint');
            $router->post('check_game_token', 'FaithController@checkGameToken');
            $router->post('report_role_info', 'FaithController@reportRoleInfo');
            $router->post('get_rank_list', 'FaithController@rankList');
            $router->post('report_rank', 'FaithController@reportRank');
            $router->post('report_point', 'FaithController@reportPoint');
            $router->post('report_task', 'FaithController@reportTask');
            $router->post('login_log', 'FaithController@loginLog');
            $router->post('report_prop_change', 'FaithController@reportPropChange');
        });

        $router->group(['prefix' => 'periphery'], function () use ($router) {
            Log::info("periphery=========================================");
            $router->post('get_version', 'FaithController@version');
            $router->post('api_agreements', 'FaithController@apiAgreements');
            $router->post('get_game_notice', 'FaithController@Notice');
            $router->get('get_maintenance_notice', 'FaithController@maintenanceNotice');
            $router->get('get_server_status', 'FaithController@serverStatus');
            $router->post('get_login_notice', 'FaithController@loginNotice');
            $router->post('verification_gift', 'FaithController@verificationGift');
            $router->post('cancel_order', 'FaithController@queryOrder');
            $router->post('query_order', 'FaithController@queryOrder');
            $router->post('pay_validate', 'FaithController@payValidate');
            $router->post('card_comment', 'FaithController@cardComment');
            $router->post('publish_comment', 'FaithController@publishComment');
            $router->post('set_card_comment_mark', 'FaithController@setCardCommentMark');
            $router->post('set_card_like', 'FaithController@setCardLike');
            $router->post('report_error', 'FaithController@reportError');

        });

    });

});
