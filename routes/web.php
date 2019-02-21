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
})->name('users.inicio');


Route::get('/usuarios', 'UserController@index')
    ->name('users.index');


Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');


Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');


Route::post('/usuarios', 'UserController@store');

//Route::post('/usuarios/crear', 'UserController@store');

Route::get('/usuarios/{user}/editar', 'UserController@edit')
    ->name('users.edit');


Route::put('/usuarios/{user}', 'UserController@update');


Route::get('/saludo/{name}/{nickname?}','WelcomeUserController');


Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');





