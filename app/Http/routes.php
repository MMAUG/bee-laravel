<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$router->get('/', 'HomeController@index');

$router->post('/test', 'HomeController@test');

/*$router->get('/shops', 'ShopController@index');
$router->post('/shops', 'ShopController@create');
$router->put('/shops', 'ShopController@update');*/

$router->resource('shop', 'ShopController',
				 array('only' => array('index', 'store', 'update', 'destroy')));

//$router->post('/shop//foods')
