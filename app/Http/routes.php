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


/*
    //Debug query
    Event::listen('illuminate.query', function($query)
     {
         var_dump($query);
     });
*/

    Route::get('/', 'PageController@home');

    Route::get('update-price', 'ProductController@priceUpdate');

//    Route::get('/', function () // temp, used for tweaking frontend
//    {
//        return view('welcome');
//    });

//    Route::get('/landing', function () // temp, used for tweaking frontend
//    {
//        return view('static.landing');
//    });

    Route::get('/product-details', function () // temp, used for tweaking frontend
    {
        return view('static.product-details');
    });

    Route::get('/kitchen-landing', function () // temp, used for tweaking frontend
    {
        return view('static.kitchen-landing');
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
         * Product route collection
         *
         * */
        Route::get('product/check-permalink/{permalink?}', 'ProductController@isPermalinkExist');
        Route::get('product/get-product/{id?}', 'ProductController@getProductById');
        Route::get('product/product-find/{name?}', 'ProductController@searchProductByName');

        Route::post('product/get-product-list', 'ProductController@getAllProductList');

        Route::post('product/add-product', 'ProductController@addProduct');
        Route::post('product/update-product', 'ProductController@updateProductInfo');
        Route::post('product/publish-product', 'ProductController@publishProduct');
        Route::get('product/get-by-name/{name?}', 'ProductController@productDetailsViewByName');


        // Delete product
        Route::post('product/delete-product', 'ProductController@deleteProduct');

        Route::get('pro-details/{permalink?}', 'ProductController@productDetailsView');

        //add to compare queue
        Route::get('pro-details/{permalink?}', 'ProductController@productDetailsView');

        // Get product Info from API
        Route::get('api-data/{itemId?}','ProductController@getProductInfoFromApi');

        /*
         *  TAG module for product
         *
         * */

        Route::post('tag/add-tag-info', 'TagsController@addTagInfo');
        Route::post('tag/update-tag-info', 'TagsController@updateTagInfo');
        Route::post('tag/delete-tag-info', 'TagsController@deleteTagInfo');
        Route::get('tag/show-tags', 'TagsController@showAllTags');
        Route::get('tag/show-tag/{productId}', 'TagsController@showTagByProductId');
        Route::get('tag/show-products/{tagId}', 'TagsController@getProductsByTag');
        Route::get('tag/search-tag/{tagId}', 'TagsController@searchTagByName');



        Route::post('tag/add-tags', 'TagsController@addTags');



        /*
         * Media upload route
         *
         * */

        Route::any('product/media-upload', 'ProductController@addMediaForProduct');
        Route::post('product/add-media-info', 'ProductController@addMediaInfo');
        Route::get('product/get-media/{id?}', 'ProductController@getMediaForProduct');
        Route::post('product/delete-media/', 'ProductController@deleteSingleMediaItem');




        /*
         * RSS feed parser from WP to App home page
         *
         * */

        Route::get('feed', 'ApiController@feedDispatcher');
    });

    // Admin Route
    Route::group(['prefix' => 'admin'], function ()
    {
        Route::get('dashboard', 'AdminController@index');

        // Category view
        Route::get('category-view', 'AdminController@categoryView');
        Route::get('category-add', 'AdminController@addCategory');
        Route::get('category-edit', 'AdminController@editCategory');

        // Product view
        Route::get('product-view', 'AdminController@productView');
        Route::get('product-add', 'AdminController@addProduct');
        Route::get('product-edit/{id?}', 'AdminController@editProduct');

        //Tag view
        Route::get('tag-view', 'AdminController@tagView');


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

    // Route for product detail view
    Route::get('pro-details/{permalink?}', 'PageController@productDetailsPage');

    Route::get('/api/paging/get-content/{page?}', 'PageController@getContent');


    // temporary category tag generator
   // Route::get('gen', 'TagsController@temporaryCategoryTagGenerator');




