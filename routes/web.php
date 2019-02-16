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
    Route::get('/make_default_category','CategoryController@addDefaultCategories')->name('make_default_category');
    Route::resource('/shop','ShopController');
    Route::resource('csv','FilesCSVController');
    Route::any('activate_csv', 'FilesCSVController@activate')->name('activate_csv');
    Route::any('disactivate_csv', 'FilesCSVController@disactivate')->name('disactivate_csv');
    Route::any('parser', 'ParserController@index')->name('parser_main');
    Route::any('upload_a_lot_photo/{csv}','FilesCSVController@upload_photo')->name('upload_photo');
});


