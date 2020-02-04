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

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'web'], function (){

    Route::group(['namespace' => 'Web\Auth', 'prefix' => 'auth', 'as' => 'web.auth.'], function (Router $router){
        $router->get('/login', 'LoginController@showLoginForm')->name('login');
        $router->post('/login', 'LoginController@login')->name('login');

        $router->get('/register', 'RegisterController@showRegistrationForm')->name('register');
        $router->post('/register', 'RegisterController@register')->name('register');
    });

});
