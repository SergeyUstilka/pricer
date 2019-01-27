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
Auth::routes();

Route::get('/catalog/{category?}','CatalogController@index')->name('catalog');
Route::get('/catalog/{category}/{product}','CatalogController@product')->name('product');



