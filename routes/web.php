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

Route::get('/', 'IndexController@index')->name('main_page');
Route::get('/home', 'IndexController@index');
Auth::routes();

Route::any('/catalog/{category?}','CatalogController@index')->name('catalog');
Route::get('/product/{category}/{product}','CatalogController@product')->name('product');

Route::post('/clever_search','SearchController@index');
Route::post('/search','SearchController@find');




Route::namespace('Admin')->middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/','HomeController@index');
    Route::resource('/product','ProductController');
    Route::resource('{product}/photo', 'PhotoController');
    Route::resource('/category','CategoryController');
    Route::resource('/shop','ShopController');
    Route::resource('csv','FilesCSVController');
});


