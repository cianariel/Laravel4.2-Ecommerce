<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    Route::get('/', function ()
    {
        return view('welcome');
    });

    Route::group(['prefix' => 'api'], function ()
    {
        Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
        Route::post('authenticate', 'AuthenticateController@authenticate');
        Route::post('register-user', 'AuthenticateController@registerUser');
        Route::get('fb-login','AuthenticateController@fbLogin');
        Route::get('secure-page','AuthenticateController@securePage');
        Route::get('index','AuthenticateController@index');
    });

    Route::get('verify-email/{code}','AuthenticateController@verifyEmail');
