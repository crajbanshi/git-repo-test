<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('hello', function () {
    return 'Hello World!!!';
});

Route::get('/repo', 'RepoController@index');

//Route::get('/repo/create', 'RepoController@create');

Route::get('/repo/search', 'RepoController@search');

Route::get('/repo/ajaxrepo', 'RepoController@ajaxrepo');