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
    return $router->app->version();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.auth', 'namespace' => 'App\Http\Controllers\V1'], function ($api) {

    $api->get('/checklists', 'ChecklistController@index');
    $api->get('/checklists/{id}', 'ChecklistController@get');
    $api->post('/checklists', 'ChecklistController@store');
    $api->patch('/checklists/{id}', 'ChecklistController@update');
    $api->delete('/checklists/{id}', 'ChecklistController@delete');
});