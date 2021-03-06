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

Route::get('/Milk', function () {
    return view('Milk');
});

Route::get('/testing', function () {
    return view('testing');
});


Route::get('skills', function(){
    return ['A','B','C'];
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'LoginController@__construct');

// CRUD for making systems
Route::get('/home', 'GalaxyController@create');
Route::post('/home', 'GalaxyController@store');
Route::get('/systems', 'GalaxyController@index');
Route::get('/home', 'GalaxyController@indexForHomeViewing');
//
Route::get('/editObj/{id}', 'GalaxyController@edit');
Route::patch('/editObj/{id}', 'GalaxyController@update');
Route::delete('/editObj/{id}', 'GalaxyController@destroy');

Route::resource('Atlas', 'GalaxyController');



