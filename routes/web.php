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


$router->get('/tim', 'TimController@index');
$router->post('/create-tim','TimController@store');
$router->put('/tim-update/{id}', 'TimController@update');
$router->delete('/tim-delete/{id}', 'TimController@destroy');

$router->get('/pemain', 'InformasiTimController@index');
$router->post('/create-pemain','InformasiTimController@store');
$router->put('/pemain-update/{id}', 'InformasiTimController@update');
$router->delete('/pemain-delete/{id}', 'InformasiTimController@destroy');

$router->get('/jadwal', 'JadwalController@index');
$router->post('/create-jadwal','JadwalController@store');
$router->put('/jadwal-update/{id}', 'JadwalController@update');
$router->delete('/jadwal-delete/{id}', 'JadwalController@destroy');

$router->get('/hasil', 'HasilController@index');
$router->post('/create-hasil','HasilController@store');
$router->put('/hasil-update/{id}', 'HasilController@update');
$router->delete('/hasil-delete/{id}', 'HasilController@destroy');

$router->get('/data', 'DataController@index');
$router->post('/create-data','DataController@store');
$router->put('/data-update/{id}', 'DataController@update');
$router->delete('/data-delete/{id}', 'DataController@destroy');
