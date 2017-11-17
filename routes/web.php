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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client1', function () {
    return view('client.welcome');
});

Route::get("/admin/article", "Admin\ArticleController@getView");
Route::get("/admin", "Admin\ArticleController@getView");
Route::get("/admin/product", "Admin\ProductArticle@getView");
Route::get("/admin/nutritionstrategy", "Admin\NutritionStrategy@getView");

