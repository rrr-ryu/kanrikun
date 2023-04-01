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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', ProductsController::class)
    ->middleware('auth');
Route::post('products/search', 'ProductsController@search')->name('products.search')
    ->middleware('auth');
Route::post('products/sort', 'ProductsController@sort')->name('products.sort')
    ->middleware('auth');
