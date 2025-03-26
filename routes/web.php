<?php

use App\Controllers\user;
use App\Controllers\auth;
use App\Routes\Route;

Route::get('/', 'UserController@create');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');
Route::get('/user/show', 'UserController@show');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');


Route::dispatch();