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
        $router->get('auth/login', 'AuthController@actionLogin');
    });

    Route::group(['middleware' => 'api.auth:api'], function(){

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

});
