<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/','ClientController@home');
Route::get('/shop','ClientController@shop');
Route::get('/cart','ClientController@cart');
Route::get('/checkout','ClientController@checkout');
Route::get('/login','ClientController@login');
Route::get('/signup','ClientController@signup');


Route::get('/admin','AdminController@dashboard');
Route::get('/orders','AdminController@orders');


Route::get('/addcategory','CategoryController@addcategory');
Route::post('/savecategory','CategoryController@savecategory');
Route::get('/categories','CategoryController@categories');
Route::get('/edit_category/{id}','CategoryController@edit');
Route::post('/updatecategory','CategoryController@updatecategory');
Route::get('/delete/{id}','CategoryController@delete');


Route::get('/addproduct', 'ProductController@addproduct');
Route::get('/products', 'ProductController@products');
Route::post('/saveproduct', 'ProductController@saveproduct');
Route::get('/edit_product/{id}','ProductController@editproduct');


Route::get('/addslider','SliderController@addslider');
Route::get('/sliders','SliderController@sliders');


