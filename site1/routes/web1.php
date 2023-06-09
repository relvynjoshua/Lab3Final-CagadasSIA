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


$router->get('/users1',['uses' => 'UserController1@index']);                          //get all users
$router->post('/users1',['uses' => 'UserController1@add']);                          //add  users
$router->get('/users1/{id}',['uses' => 'UserController1@show']);                     //get users by id
$router->put('/update/users1/{id}',['uses' => 'UserController1@updateUser']);          //UPDATE users by id
$router->delete('/users1/{id}',['uses' => 'UserController1@deleteUser']);           //delete user record

// USERJOB ROUTES

$router->get('/userjob1',['uses' => 'UserJobController@index']);             //get all jobs
$router->get('/userjob1/{id}',['uses' => 'UserJobController@show']);            //get jobs by id