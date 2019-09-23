<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * RUTAS PARA REGISTRO, LOGIN Y LOGOUT
 *
 * */

date_default_timezone_set('America/Bogota');


Route::post('register', 'Api\UserController@store');

Route::post('login', 'Api\Auth\LoginController@login');

Route::post('logout', 'Api\Auth\LoginController@logout');

Route::get('users/{id}', 'Api\UserController@show');

#Route::get('menusByModality/{id}', 'Api\MenuModalidadController@index');
Route::get('menus', 'Api\MenuController@index');

Route::get('newOrderNotification/{menu_id}', 'Api\PushNotificationController@newOrderNotification');

Route::get('updateFMCTocken/{user_id}/{fmcTocken}', 'Api\PushNotificationController@updateFMCTocken');

/*
*
* RUTAS PARA EL MANEJO DE ORDENES
* */

Route::resource('orders','Api\OrderController',
    [
        'except'=> ['create','edit']
    ]);

/**
 * RUTAS QUE NECESITAN AUTORIZACIÓN
 */

Route::group(['middleware' => 'auth:api'], function() {


    /**
     * RUTAS MANEJO DE ORDENES
     */

    Route::get('ordersByChef/{chef_id}', 'Api\OrderController@showByChef');


    Route::get('ordersByDiner/{diner_id}', 'Api\OrderController@showByDiner');




    /*
     * RUTAS PARA MANEJO DE USUARIOS
     *
     * */

    Route::prefix('users')->group(function () {

        Route::get('/', 'Api\UserController@index');

//        Route::get('/{id}', 'Api\UserController@show');

//        Route::post('/', 'Api\UserController@store');

        Route::put('/{id}', 'Api\UserController@update');

        Route::delete('/{id}', 'Api\UserController@destroy');

    });

    /*
     *
     * RUTAS PARA EL MANEJO DE MENUS
     * */

    Route::resource('menus','Api\MenuController',
        [
            'except'=> ['create','edit','index']
        ]);

    Route::get('menusByChef/{id}', 'Api\MenuController@menusByChef');


});
