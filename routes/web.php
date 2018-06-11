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

/**
 * @var $router \Laravel\Lumen\Routing\Router
 */


//$router->get('apps/create', 'AppController@create');
//$router->post('apps/create', 'AppController@create');
//$router->get('apps/{id}', 'AppController@detail');
//$router->get('users', 'UserController@list');
//$router->get('users/{id}', 'UserController@detail');
//$router->get('groups', 'GroupController@list');
//$router->get('groups/{id}/users', 'GroupController@userList');
//$router->get('groups/create', 'GroupController@create');
//$router->post('groups/create', 'GroupController@create');

//不需要登录的页面
$router->get('login', 'IndexController@login');
$router->get('oauth', 'IndexController@oauth');

//api
$router->group([
    'prefix' => 'api',
    'namespace' => 'Api',
    'middleware' => 'api',
], function () use ($router) {
    $router->get('access_token','AuthController@accessToken');
    $router->get('/user_info', 'UserController@info');
});

//操作后台
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'IndexController@index');
    $router->get('/logout', 'IndexController@logout');
    $router->get('/connect', 'ConnectController@index');
    $router->get('/connect/email', 'ConnectController@email');

    $router->get('apps', 'AppController@list');
    $router->get('roles', 'RolesController@roles');
    $router->post('roles/add', 'RolesController@add');
    $router->get('roles/users', 'RolesController@users');
    $router->post('roles/users/add', 'RolesController@addUser');
    $router->get('roles/users/del', 'RolesController@delUser');
    $router->get('users', 'UserController@users');

});
