<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

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

Route::group(['namespace' => 'Api'], function () {

    Route::group(['namespace' => 'User', 'prefix' => 'user'], function (Router $router){
        $router->get('auth/failed', 'AuthController@actionFailed')->name('api.user.auth.failed');
        $router->post('auth/login', 'AuthController@actionLogin');
        $router->post('auth/register', 'AuthController@actionRegister')->name('api.user.auth.register');
    });

    Route::group(['middleware' => 'api.auth:api'], function(){

        Route::group(['namespace' => 'User', 'prefix' => 'user'], function (Router $router){
            $router->post('auth/logout', 'AuthController@actionLogout')->name('api.user.auth.logout');
        });

        Route::group(['prefix' => 'reviews'], function (Router $router){
            $router->post('add', 'ReviewsController@actionAdd')->name('api.reviews.add');
        });

    });

    Route::group(['prefix' => 'hospitals'], function (Router $router) {
        $router->get('list', 'HospitalsController@actionList')->name('api.hospitals.list');
        $router->get('show', 'HospitalsController@actionShow')->name('api.hospitals.show');
    });

    Route::group(['prefix' => 'doctors'], function (Router $router) {
        $router->get('show', 'DoctorsController@actionShow')->name('api.doctors.show');
    });

});
