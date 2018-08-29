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

$router->get('/review/list', 'RestController@list');
$router->post('/review/save', 'RestController@save');
$router->post('/review/update', 'RestController@update');
$router->post('/review/delete', 'RestController@delete');