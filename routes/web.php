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

$router->get('/', function () {
	return response([
		'message' => 'ENGSOLUC-API'
	], 200);
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
	$router->post('/generate/form', 'FormController@create');
	$router->get('/forms', 'FormController@index');
});
