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
$router->get('/user', 'AuthController@all');
$router->post('/register', 'AuthController@register');

$router->resource('shop', 'ShopController',
				 array('only' => array('index', 'store', 'update', 'destroy')));

$router->get('categories', 'ShopController@categories');

//$router->post('/shop//foods')
