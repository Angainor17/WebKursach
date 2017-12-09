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

Route::get("/", "Client\NewsPageController@getView");

////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/home', 'Client\NewsPageController@getView')->name('home');
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("/productsList", "Client\ProductListController@getView");
Route::get("/products", "Client\ProductListController@getProductsList");
Route::post("/addToCart", "Client\ProductListController@addToCart");
Route::get("/product/{id}", "Client\SelectedProductController@getView");
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("/articles", "Client\NewsPageController@getArticlesList");
Route::get("/article/{id}", "Client\SelectedNewsController@getView")->name("article");
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("/basket", "Client\BasketController@getView")->name("basket");
Route::post("/makeOrder", "Client\BasketController@makeOrder");
Route::get("/removeFromBasket/{id}", "Client\BasketController@remove");
Route::get("/basketProductList", "Client\BasketController@getProductList");
Route::get("/getTotalCost", "Client\BasketController@getTotalCost");
Route::get("/account", "Client\AccountController@getView")->name("account");
Route::post("/accountRefresh", "Client\AccountController@refreshData");

Route::get('/about', 'Client\AboutController@getView');
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("/orders", "Client\OrdersController@getView")->name("orders");
Route::get("/orderslist", "Client\OrdersController@getOrderList");
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("/nutritionStrategy", "Client\NutritionController@getView")->name("nutrition");
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("/admin", "Admin\ArticleController@getView");
Route::get("/admin/article/list", "Admin\ArticleController@getArticleDataTable");
Route::get('/admin/article/delete/{id}', 'Admin\ArticleController@deleteRow');
Route::post('/admin/article/add', 'Admin\ArticleController@addItem');
Route::post('/admin/article/update', 'Admin\ArticleController@updateItem');
Route::get('/admin/article/get/{id}', 'Admin\ArticleController@getArticleById');
Route::get("/admin/article", "Admin\ArticleController@getView");


Route::post('/admin/uploadFile', 'Admin\ArticleController@uploadFile');

Route::get("/admin/product", "Admin\ProductController@getView");
Route::get("/admin/product/list", "Admin\ProductController@getProductsDataTable");
Route::get('/admin/product/delete/{id}', 'Admin\ProductController@deleteRow');
Route::post('/admin/product/add', 'Admin\ProductController@addItem');
Route::post('/admin/product/update', 'Admin\ProductController@updateItem');
Route::get('/admin/product/get/{id}', 'Admin\ProductController@getProductById');


Route::get("/admin/nutritionstrategy", "Admin\NutritionStrategyController@getView");
Route::post("/admin/updateNs", "Admin\NutritionStrategyController@update");
Route::get("/admin/getListNs", "Admin\NutritionStrategyController@getList");


Route::post("/language-chooser", "LanguageController@changeLanguage");


Route::post("/language/", array(
    'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@changeLanguage',
));


Auth::routes();


