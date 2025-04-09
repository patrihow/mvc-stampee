<?php

use App\Routes\Route;

Route::get('/', 'UserController@create');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');
Route::get('/user/show', 'UserController@show');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');

Route::get('/stamp/create', 'StampController@create');
Route::post('/stamp/create', 'StampController@store');
Route::get('/stamp/create-image', 'StampController@createImage');
Route::post('/stamp/create-image', 'StampController@storeCreateImage');
Route::get('/stamp/index', 'StampController@index');
Route::get('/stamp/edit', 'StampController@edit');
Route::post('/stamp/edit', 'StampController@update');
Route::post('/stamp/delete', 'StampController@delete');

Route::get('/auction?year=2000&etat', 'AuctionController@index');
Route::get('/auction/show', 'AuctionController@show');

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::dispatch();
