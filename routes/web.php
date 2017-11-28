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


Route::get("/admin/nutritionstrategy", "Admin\NutritionStrategy@getView");
Route::get("/admin/nuttitionstategydelete", "Admin\NutritionStrategy@getView");



