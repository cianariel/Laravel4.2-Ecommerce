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

// test route
Route::get('x', 'HeartController@recentHeartedUsers');


Route::any('secure-page-header', 'UserController@securePageHeader');


Route::get('/', 'PageController@home');

Route::get('update-price', 'ProductController@priceUpdate');

Route::get('unsubscribe', 'PageController@home');


//    Route::get('/product-details', function () // temp, used for tweaking frontend
//    {
//        return view('static.product-details');
//    });

Route::get('/contactus', 'PageController@contactUs');
Route::get('/aboutus', 'PageController@aboutUs');
Route::get('/privacy-policy', 'PageController@privacyPolicy');
Route::get('/terms-of-use', 'PageController@termsOfUse');
Route::get('giveaway/{permalink?}', 'PageController@giveaway');
//Route::get('giveaway-details/{permalink?}', 'PageController@giveaway');

Route::group(['prefix' => 'api'], function () {
    /*
     * Comments
     * */
    Route::post('comment/add-product-comment', 'CommentController@addCommentForProduct');
    Route::get('comment/get-product-comment/{pid?}', 'CommentController@getCommentForProduct');
    Route::post('comment/update-product-comment', 'CommentController@updateCommentForProduct');
    Route::post('comment/delete-product-comment', 'CommentController@deleteCommentForProduct');

    Route::post('comment/add-ideas-comment', 'CommentController@addCommentForIdeas');
    Route::get('comment/get-ideas-comment/{pid?}', 'CommentController@getCommentForIdeas');

    Route::post('comment/update-comment', 'CommentController@updateComment');
    Route::post('comment/delete-comment', 'CommentController@deleteComment');


    /*
     *  Heart Counter
     * */
    Route::post('heart/add-heart', 'HeartController@addHeart');
    Route::post('heart/count-heart', 'HeartController@heartCounter');
    Route::post('heart/heart-users', 'HeartController@recentHeartedUsers');


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
    // check authentication and return data through api
    Route::get('auth-check', 'AuthenticateController@authCheckApi');


    Route::post('info', 'UserController@getUserByEmail');
    Route::get('info', 'UserController@getUserByEmail');
    Route::get('info-raw/{email?}', 'UserController@getUserByEmailRaw');


    Route::get('wp', 'UserController@getWpUsers');


    /*
     * User management for Admin Panel
     * */

    Route::post('user/user-list', 'UserController@userList');
    Route::post('user/subscriber-list', 'UserController@subscriberList');
    Route::get('user/download/subscriber-list', 'UserController@downloadSubscribersList');

    Route::get('user/get-user/{id?}', 'UserController@getUserById');
    // Route::any('user/user-add/{id?}','UserController@userList');


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

    Route::get('category/get-category-hierarchy/{catId?}', 'ProductController@generateCategoryHierarchy');

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

    // Test method for logo
    Route::get('product/logo', 'ProductController@getStoreInformation');

    // Delete product
    Route::post('product/delete-product', 'ProductController@deleteProduct');

    //add to compare queue
    Route::get('pro-details/{permalink?}', 'ProductController@productDetailsView');

    // Get product Info from API
    Route::get('api-data/{itemId?}', 'ProductController@getProductInfoFromApi');

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

    Route::any('product/media-upload', 'ProductController@fileUploader');
    Route::post('product/add-media-info', 'ProductController@addMediaInfo');
    Route::get('product/get-media/{id?}', 'ProductController@getMediaForProduct');
    Route::post('product/delete-media', 'ProductController@deleteSingleMediaItem');

    Route::post('media/update-media', 'MediaController@updateMediaContent');
    Route::any('media/media-upload', 'MediaController@fileUploader');
    Route::post('media/media-delete', 'MediaController@fileUploader');

    /*
     * Store
     * */
    Route::post('store/update-store', 'StoreController@updateStore');
    Route::post('store/delete-store', 'StoreController@deleteStore');
    Route::post('store/change-status', 'StoreController@changeStatus');

    Route::get('store/show-stores', 'StoreController@getAllStores');

    Route::post('room/add-room', 'RoomController@addRoom');
    Route::post('room/update-room', 'RoomController@updateRoom');
    Route::post('room/delete-room', 'RoomController@deleteRoom');

    Route::post('homehero/add-home-hero', 'RoomController@addHomeHero');
    Route::post('homehero/update-home-hero', 'RoomController@updateHomeHero');
    Route::post('homehero/delete-home-hero', 'RoomController@deleteHomeHero');

    Route::post('giveaway/add-giveaway', 'GiveawayController@addGiveaway');
    Route::post('giveaway/get-giveaway-list', 'GiveawayController@getGiveawayList');
    Route::post('giveaway/update-giveaway', 'GiveawayController@updateGiveaway');
    Route::post('giveaway/delete-giveaway', 'GiveawayController@deleteGiveaway');

    /*
     * User route collection
     * */

    Route::post('subscribe', 'UserController@emailSubscription');

    Route::post('contact-us', 'UserController@postContactUsInfo');

    /*
     * Notification
     * */
    Route::get('notification/{uid?}', 'UserController@notification');
    Route::get('read-all-notification/{uid?}', 'UserController@notificationReadAll');

    /*
     * User Activity
     * */
    Route::post('user-activity', 'UserController@getUserActivity');


    /*
     * RSS feed parser from WP to App home page
     *
     * */

    Route::get('feed', 'ApiController@feedDispatcher');
});

    Route::post('/api/giveaway/enter', 'GiveawayController@enterUser');
    Route::get('/api/giveaway/enter', 'GiveawayController@enterUser');
    Route::get('/api/giveaway/get-current', 'GiveawayController@getCurrentGiveaway');

// Admin Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');

    // Category view
    Route::get('category-view', 'AdminController@categoryView');
    Route::get('category-add', 'AdminController@addCategory');
    Route::get('category-edit', 'AdminController@editCategory');

    // Product view
    Route::get('product-view', 'AdminController@productView');
    Route::get('product-add', 'AdminController@addProduct');
    Route::get('product-edit/{id?}', 'AdminController@editProduct');

    // Stores View
    Route::get('stores', 'AdminController@storeView');

    //Tag view
    Route::get('tag-view', 'AdminController@tagView');

    //Room view
    Route::get('room-view', 'AdminController@roomsView');
    Route::get('room-add', 'AdminController@addRoom');
    Route::get('room-edit/{id?}', 'AdminController@editRoom');

    //Home Hero view
    Route::get('home-hero-view', 'AdminController@homeHeroView');
    Route::get('home-hero-add', 'AdminController@addHomeHero');
    Route::get('home-hero-edit/{id?}', 'AdminController@editHomeHero');

    //Giveaway view
    Route::get('giveaway-view', 'AdminController@giveawayView');
    Route::get('giveaway-add', 'AdminController@addGiveaway');
    Route::get('giveaway-edit/{id?}', 'AdminController@editGiveaway');

    // User View
    Route::get('user-list', 'AdminController@userList');
    Route::get('user-add/{id?}', 'AdminController@userEdit');
    Route::get('subscribers-list', 'AdminController@subscriberList');

});

//Shop view
//    Route::get('shop/{categoty?}', 'ShopController@index');
//    Route::get('shop/{parent?}/{categoty?}', 'ShopController@index');
Route::get('shop/{grandParent?}/{parent?}/{child?}', ['as' => 'shopCategory', 'uses' => 'ShopController@index']);
//    Route::get('shop/travel/{categoty?}', 'ShopController@index');
//    Route::get('shop/wearables/{categoty?}', 'ShopController@index');
//    Route::get('shop/home-decor/{categoty?}', 'ShopController@index');

//User Profile
Route::get('user/profile', 'UserController@userProfile');
Route::get('user/profile/{permalink?}', 'UserController@viewPublicProfile');


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
//    Route::get('pro-details/{permalink?}', 'PageController@productDetailsPage');
Route::get('product/{permalink?}', ['as' => 'productDetails', 'uses' => 'PageController@productDetailsPage']);
Route::get('idea/{permalink?}', 'PageController@getRoomPage'); // single room page
Route::get('room/{permalink?}', 'PageController@getRoomPage'); // temp keeping the old link, to prevent breaks
// default signup
Route::get('signup/{email?}', 'PageController@signupPage');
Route::get('login', 'PageController@loginView');

// Hide signup popup
Route::get('hide-signup', 'UserController@hideSignup');
Route::get('cookie/{cookieName?}', 'ApiController@getCookie');


// default
//    Route::get('login', 'PageController@loginView');

Route::get('sitemap', 'PageController@generateSitemap');

Route::get('/api/paging/get-content/{page?}/{limit?}/{type?}/{tag?}/{productCategory?}/{sortBy?}', 'PageController@getContent');
Route::get('/api/paging/get-grid-content/{page?}/{limit?}/{tag?}/{type?}/{ideaCategory?}', 'PageController@getGridContent');
Route::get('/api/layout/get-shop-menu', 'PageController@getShopMenu');
Route::get('/api/social/get-social-counts', 'PageController@getSocialCounts');
Route::get('/api/social/get-fan-counts', 'PageController@getFollowerCounts');

Route::get('api/find/{query?}/{limit?}/{offset?}/{type?}/{sort?}', 'SearchController@searchData');

Route::get('api/search/do/index/{indexType?}', 'SearchController@indexData');
Route::get('api/search/find-categories/{quert?}', 'SearchController@searchCategories');

Route::get('search-form-query', 'SearchController@formatAndRedirectSearch');
Route::get('search/{query?}', 'PageController@searchPage');



// temporary category tag generator
// Route::get('gen', 'TagsController@temporaryCategoryTagGenerator');


