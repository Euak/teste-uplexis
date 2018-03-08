<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('consulta', ['middleware' => 'auth', 'uses' => 'ConsultaController@index']);
Route::get('listar', ['middleware' => 'auth', 'uses' => 'ConsultaController@listar']);
Route::get('excluir/{id}', ['middleware' => 'auth', 'uses' => 'ConsultaController@excluir']);

Route::get('/auth/login', 'Auth\AuthController@login');
Route::get('/auth/logout', 'Auth\AuthController@logout');
Route::post('/auth/authenticate', 'Auth\AuthController@authenticate');

Route::get('api/sintegra/es/{cnpj}', ['middleware' => 'auth.api', 'uses' => 'ConsultaController@consultar']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
