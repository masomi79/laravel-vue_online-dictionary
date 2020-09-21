<?php

use Illuminate\Support\Facades\Route;

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
    return view('app.main');
});

Route::get('/{slug}', 'AdminController@index');


//API
Route::get('/api/getMiskitoWordList', 'AdminController@getmiskitowordlist');
Route::post('/api/getSearchResult', 'AdminController@getSearchResult');
