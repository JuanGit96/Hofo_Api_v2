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

if(! defined('PATH_MOD_USERS'))
    define('PATH_MOD_ADMIN', 'Admin\\');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


    /*
 * RUTAS SECCION ADMINISTRATIVA
 * */

Route::group(['prefix'=>'admin'], function () {

    Route::resource('users',PATH_MOD_ADMIN.'UserController');

    Route::resource('menus',PATH_MOD_ADMIN.'MenuController');

    Route::resource('orders',PATH_MOD_ADMIN.'OrderController');

});
