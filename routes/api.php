<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| apis Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/forgot', 'AuthController@forgot');
    $router->post('/reset_password', 'VerifyController@reset_password');
});

$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('/validate_token', 'ProfileController@validateToken');
});

$router->group(['prefix' => 'qualification', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'QualificationController@getInfo');
    $router->post('/getListByOption', 'QualificationController@getListByOption');
});

$router->group(['prefix' => 'qualification', 'middleware' => ['admin']], function () use ($router) {
    $router->post('/create', 'QualificationController@create');
});






