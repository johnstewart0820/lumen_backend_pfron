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

$router->group(['prefix' => 'candidate', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'CandidateController@getInfo');
    $router->post('/getListByOption', 'CandidateController@getListByOption');
});

$router->group(['prefix' => 'candidate', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'CandidateController@get');
    $router->post('/', 'CandidateController@create');
    $router->put('/',  'CandidateController@update');
    $router->delete('/', 'CandidateController@delete');
    $router->get('/get_marker', 'CandidateController@getMarker');
    $router->get('/candidate_info', 'CandidateController@getCandidateInfo');
    $router->put('/step1', 'CandidateController@updateStep1');
    $router->put('/step2', 'CandidateController@updateStep2');
    $router->put('/step3', 'CandidateController@updateStep3');
    $router->put('/step4', 'CandidateController@updateStep4');
});

$router->group(['prefix' => 'participant', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'ParticipantController@getInfo');
    $router->post('/getListByOption', 'ParticipantController@getListByOption');
    $router->get('/', 'ParticipantController@get');
    $router->put('/',  'ParticipantController@update');
});

$router->group(['prefix' => 'qualification', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'QualificationController@getInfo');
    $router->post('/getListByOption', 'QualificationController@getListByOption');
    $router->get('/', 'QualificationController@get');
    $router->post('/', 'QualificationController@create');
    $router->put('/',  'QualificationController@update');
    $router->delete('/', 'QualificationController@delete');
});

$router->group(['prefix' => 'specialist', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'SpecialistController@getInfo');
    $router->post('/getListByOption', 'SpecialistController@getListByOption');
});

$router->group(['prefix' => 'specialist', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'SpecialistController@get');
    $router->post('/', 'SpecialistController@create');
    $router->put('/',  'SpecialistController@update');
    $router->delete('/', 'SpecialistController@delete');
});

$router->group(['prefix' => 'audit', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'AuditController@getInfo');
    $router->post('/getListByOption', 'AuditController@getListByOption');
});

$router->group(['prefix' => 'audit', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'AuditController@get');
    $router->delete('/', 'AuditController@delete');
});

$router->group(['prefix' => 'users', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'UserController@getInfo');
    $router->post('/getListByOption', 'UserController@getListByOption');
    $router->get('/getProfile', 'UserController@getProfile');
    $router->put('/updateProfile', 'UserController@updateProfile');
});

$router->group(['prefix' => 'users', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'UserController@get');
    $router->post('/', 'UserController@create');
    $router->put('/',  'UserController@update');
    $router->delete('/', 'UserController@delete');
});

$router->group(['prefix' => 'service-list', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'ServiceListController@getInfo');
    $router->post('/getListByOption', 'ServiceListController@getListByOption');
});

$router->group(['prefix' => 'service-list', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'ServiceListController@get');
    $router->post('/', 'ServiceListController@create');
    $router->put('/',  'ServiceListController@update');
    $router->delete('/', 'ServiceListController@delete');
});

$router->group(['prefix' => 'rehabitation-center', 'middleware' => ['auth']], function () use ($router) {
    $router->post('/getListByOption', 'RehabitationCenterController@getListByOption');
});

$router->group(['prefix' => 'rehabitation-center', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'RehabitationCenterController@get');
    $router->put('/',  'RehabitationCenterController@update');
});


$router->group(['prefix' => 'ork-team', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'OrkTeamsController@getInfo');
    $router->post('/getListByOption', 'OrkTeamsController@getListByOption');
});

$router->group(['prefix' => 'ork-team', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'OrkTeamsController@get');
    $router->post('/', 'OrkTeamsController@create');
    $router->put('/',  'OrkTeamsController@update');
    $router->delete('/', 'OrkTeamsController@delete');
});

$router->group(['prefix' => 'payment', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'PaymentController@getInfo');
    $router->post('/getListByOption', 'PaymentController@getListByOption');
});

$router->group(['prefix' => 'payment', 'middleware' => ['admin']], function () use ($router) {
    $router->get('/', 'PaymentController@get');
    $router->post('/', 'PaymentController@create');
    $router->put('/',  'PaymentController@update');
    $router->delete('/', 'PaymentController@delete');
});


