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
        $router->get('routetable', 'RouteController@table');

        // Article operate.
        $router->get('article/list', 'ArticleController@get_list');
        $router->get('article/detail', 'ArticleController@detail');
        $router->get('article/pv', 'ArticleController@pv');
        $router->post('article/create', 'ArticleController@create');
        $router->post('article/update', 'ArticleController@update');

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

});
