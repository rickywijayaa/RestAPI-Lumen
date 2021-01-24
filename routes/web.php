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

$router->get('/', function () {
    return 'Hello World';
});

$router->get('/student','StudentController@index');
$router->post('/student','StudentController@create');
$router->post('/student/{id}','StudentController@show');
$router->put('/student/{id}','StudentController@update');
$router->delete('/student/{id}','StudentController@delete');

$router->get('/users','UserController@index');
$router->post('/register','UserController@register');
$router->post('/login','UserController@login');

