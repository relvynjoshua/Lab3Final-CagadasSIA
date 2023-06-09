<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function($router) {
    $router->get('users', 'UserController@index');

    $router->get('users/{id}', 'UserController@show');

    $router->post('users', 'UserController@addUser');

    $router->delete('users/{id}', 'UserController@deleteUser');

    $router->patch('/users/{id}', 'UserController@updateUser');

    $router->get('/userjob',['uses' => 'UserJobController@index']);       

    $router->get('/userjob/{id}',['uses' => 'UserJobController@show']);      
});