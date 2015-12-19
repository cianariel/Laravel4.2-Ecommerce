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

    Route::get('/', 'PageController@home');

    Route::get('/landing', function () // temp, used for tweaking frontend
    {
        return view('static.landing');
    });

    Route::group(['prefix' => 'api'], function ()
    {
        /*
         * User Authentication route collection
         *
         * */
        Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
        Route::post('authenticate', 'AuthenticateController@authenticate');
        Route::post('register-user', 'AuthenticateController@registerUser');
        Route::get('fb-login', 'AuthenticateController@fbLogin');
        Route::get('secure-page', 'AuthenticateController@securePage');
        Route::get('index', 'AuthenticateController@index');
        //Route::get('password-rest/{code?}', 'AuthenticateController@index');
        Route::post('password-reset/', 'AuthenticateController@passwordReset');
        Route::post('change-profile', 'AuthenticateController@changeProfile');

        Route::post('secure-page', 'AuthenticateController@securePage');
        Route::any('logout', 'AuthenticateController@logOut');

        /*
         * Product Category route collection
         *
         * */
        Route::get('category/index-category', 'ProductCategoryController@index');
        Route::post('category/add-category', 'ProductCategoryController@addCategory');
        Route::post('category/delete-category', 'ProductCategoryController@destroy');
        Route::get('category/root-category', 'ProductCategoryController@showAllRootCategory');
        Route::post('category/update-category', 'ProductCategoryController@updateCategory');
        Route::get('category/show-category-items/{id?}', 'ProductCategoryController@showCategoryItems');



        /*
         * RSS feed parser from WP to App home page
         *
         * */

        Route::get('feed', 'ApiController@feedDispatcher');
    });

    // Route for password reset , email verification ,feed example
    Route::get('password-reset-form/{code?}', 'AuthenticateController@passwordResetForm');

    Route::get('verify-email/{code}', 'AuthenticateController@verifyEmail');
    Route::get('password-reset-request/{Email}', 'AuthenticateController@sendPasswordResetEmail');

    // GET for token parsing and POST for password reset through ..api/password-rest/ [POST] method
    Route::get('password-reset/{code?}', 'AuthenticateController@passwordReset');

    Route::resource('feed', 'FeedController', ['only' => ['index']]);

    // Category dynamic routing
    Route::get('category/{identity?}', 'ProductCategoryController@showProductInCategoryName');


    // Admin Route
    // Admin Route
    Route::group(['prefix' => 'admin'], function ()
    {
        Route::get('dashboard', 'AdminController@index');
        Route::get('category-list', 'AdminController@categoryList');
        Route::get('category-add', 'AdminController@addCategory');
        Route::get('category-edit', 'AdminController@editCategory');

    });