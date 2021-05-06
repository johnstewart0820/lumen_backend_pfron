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

$router->group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () use ($router) {
    $router->post('/list', 'DashboardController@getList');
    $router->delete('/', 'DashboardController@delete');
});

$router->group(['prefix' => 'candidate', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'CandidateController@getInfo');
    $router->get('/total', 'CandidateController@getTotalCandidateList');
    $router->get('/history_info', 'CandidateController@getHistoryInfo');
    $router->post('/getListByOption', 'CandidateController@getListByOption');
    $router->post('/getHistoryListByOption', 'CandidateController@getHistoryListByOption');
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
    $router->get('/total', 'ParticipantController@getTotalParticipantList');
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

$router->group(['prefix' => 'ipr', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'IprController@getInfo');
    $router->get('/ork_person', 'IprController@getOrkPerson');
    $router->get('/get_plan_info', 'IprController@getPlanInfo');
    $router->post('/get_schedule', 'IprController@getScheduleInfo');
    $router->post('/get_week_schedule', 'IprController@getWeekScheduleInfo');
    $router->get('/get_balance', 'IprController@getBalanceInfo');
    $router->post('/getListByOption', 'IprController@getListByOption');
    $router->post('/plan', 'IprController@updatePlan');
    $router->post('/schedule', 'IprController@updateSchedule');
    $router->post('/week_status', 'IprController@getWeekStatus');
    $router->post('/ipr_balance', 'IprController@updateBalance');

    $router->get('/', 'IprController@get');
    $router->post('/', 'IprController@create');
    $router->post('/duplicate', 'IprController@duplicate');
    $router->put('/',  'IprController@update');
    $router->delete('/', 'IprController@delete');
});

$router->group(['prefix' => 'specialist', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'SpecialistController@getInfo');
    $router->post('/getListByOption', 'SpecialistController@getListByOption');
});

$router->group(['prefix' => 'specialist', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'SpecialistController@get');
    $router->post('/', 'SpecialistController@create');
    $router->put('/',  'SpecialistController@update');
    $router->delete('/', 'SpecialistController@delete');
});

$router->group(['prefix' => 'training', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'TrainingController@getInfo');
    $router->get('/ork_team', 'TrainingController@getOrkTeam');
    $router->post('/getListByOption', 'TrainingController@getListByOption');
    $router->get('/', 'TrainingController@get');
    $router->post('/', 'TrainingController@create');
    $router->put('/',  'TrainingController@update');
    $router->delete('/', 'TrainingController@delete');
});

$router->group(['prefix' => 'audit', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'AuditController@getInfo');
    $router->post('/getListByOption', 'AuditController@getListByOption');
});

$router->group(['prefix' => 'audit', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'AuditController@get');
    $router->delete('/', 'AuditController@delete');
});

$router->group(['prefix' => 'users', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'UserController@getInfo');
    $router->post('/getListByOption', 'UserController@getListByOption');
    $router->get('/getProfile', 'UserController@getProfile');
    $router->put('/updateProfile', 'UserController@updateProfile');
});

$router->group(['prefix' => 'users', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'UserController@get');
    $router->post('/', 'UserController@create');
    $router->put('/',  'UserController@update');
    $router->delete('/', 'UserController@delete');
});

$router->group(['prefix' => 'service-list', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'ServiceListController@getInfo');
    $router->post('/getListByOption', 'ServiceListController@getListByOption');
});

$router->group(['prefix' => 'service-list', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'ServiceListController@get');
    $router->post('/', 'ServiceListController@create');
    $router->put('/',  'ServiceListController@update');
    $router->delete('/', 'ServiceListController@delete');
});

$router->group(['prefix' => 'rehabitation-center', 'middleware' => ['auth']], function () use ($router) {
    $router->post('/getListByOption', 'RehabitationCenterController@getListByOption');
});

$router->group(['prefix' => 'rehabitation-center', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'RehabitationCenterController@get');
    $router->put('/',  'RehabitationCenterController@update');
});


$router->group(['prefix' => 'ork-team', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'OrkTeamsController@getInfo');
    $router->post('/getListByOption', 'OrkTeamsController@getListByOption');
});

$router->group(['prefix' => 'ork-team', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'OrkTeamsController@get');
    $router->post('/', 'OrkTeamsController@create');
    $router->put('/',  'OrkTeamsController@update');
    $router->delete('/', 'OrkTeamsController@delete');
});

$router->group(['prefix' => 'payment', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/info', 'PaymentController@getInfo');
    $router->post('/getListByOption', 'PaymentController@getListByOption');
});

$router->group(['prefix' => 'payment', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/', 'PaymentController@get');
    $router->post('/', 'PaymentController@create');
    $router->put('/',  'PaymentController@update');
    $router->delete('/', 'PaymentController@delete');
});

$router->group(['prefix' => 'report', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/service_info', 'ReportController@getServiceInfo');
    $router->get('/service_quater', 'ReportController@getServiceQuater');
    $router->get('/service_data', 'ReportController@getServiceData');
    $router->get('/recruitment_data', 'ReportController@getRecruitmentData');
    $router->get('/overdone_data', 'ReportController@getOverDoneData');
    $router->get('/rehabitation_data', 'ReportController@getRehabitationData');
});

$router->group(['prefix' => 'notification', 'middleware' => ['auth']], function () use ($router) {
    $router->post('/getListByOption', 'NotificationController@getListByOption');
    $router->get('/', 'NotificationController@getNotification');
    $router->get('/setting', 'NotificationController@getNotificationSetting');
    $router->put('/', 'NotificationController@updateStatusNotification');
    $router->put('/setting', 'NotificationController@updateNotificationSetting');
    $router->delete('/', 'NotificationController@deleteNotification');
});

