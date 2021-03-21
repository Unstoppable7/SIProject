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

Route::get('/', 'PageController@products');
Route::get('list/{product}', 'PageController@product')->name('product');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'Backend\ProductController')
    ->middleware('auth')
    ->except('show');
