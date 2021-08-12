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

Route::get('/', 'ClientController@home');
Route::get('/shop', 'ClientController@shop');
Route::get('/cart', 'ClientController@cart');
Route::get('/checkout', 'ClientController@checkout');
Route::get('/login', 'ClientController@login');
Route::get('/signup', 'ClientController@signup');
Route::post('/updateqty', 'ClientController@updateqty');
Route::get('/removeitem/{id}', 'ClientController@removeitem');
Route::post('postcheckout', 'ClientController@postcheckout');


Route::post('/createaccount', 'ClientController@createaccount');
Route::post('/accsesaccount', 'ClientController@accsesaccount');
Route::get('/logout', 'ClientController@logout');
Route::get('/contactus', 'ClientController@contactus');
Route::post('/datacontact', 'ClientController@datacontact');
Route::get('/profile', 'ClientController@profile');


Route::get('/about', 'ClientController@about'); //------------about route--------------------------
Route::get('/privacypolicy', 'ClientController@privacypolicy'); //------------privacypolicy route-------------
Route::get('/terms', 'ClientController@terms'); //------------terms route-------------
Route::get('/shipping', 'ClientController@shipping'); //------------shipping route-------------
Route::get('/returns', 'ClientController@returns'); //------------returns route-------------



Route::get('/view_pdf/{id}', 'PdfController@viewpdf');


Route::get('/admin', 'AdminController@dashboard');
Route::get('/orders', 'AdminController@orders');
Route::get('/new_orders', 'AdminController@new_orders');
Route::get('/delivered/{id}', 'AdminController@delivered');
Route::get('/loginadmin', 'AdminController@login');
Route::get('/signupadmin', 'AdminController@signup');
Route::post('/createaccountadmin', 'AdminController@createaccount');
Route::post('/accsesaccountadmin', 'AdminController@accsesaccount');
// Route::get('/logoutadmin', 'AdminController@logout');


Route::get('/addcategory', 'CategoryController@addcategory');
Route::post('/savecategory', 'CategoryController@savecategory');
Route::get('/categories', 'CategoryController@categories');
Route::get('/edit_category/{id}', 'CategoryController@edit');
Route::post('/updatecategory', 'CategoryController@updatecategory');
Route::get('/delete/{id}', 'CategoryController@delete');
Route::get('/view_by_cat/{name}', 'CategoryController@view_by_cat');


Route::get('/addproduct', 'ProductController@addproduct');
Route::get('/products', 'ProductController@products');
Route::post('/saveproduct', 'ProductController@saveproduct');
Route::get('/edit_product/{id}', 'ProductController@editproduct');
Route::post('/updateproduct', 'ProductController@updateproduct');
Route::get('/delete_product/{id}', 'ProductController@delete_product');
Route::get('/activate_product/{id}', 'ProductController@activate_product');
Route::get('/unactivate_product/{id}', 'ProductController@unactivate_product');
Route::get('/addToCart/{id}', 'ProductController@addToCart');


Route::get('/sliders', 'SliderController@sliders');
Route::get('/addslider', 'SliderController@addslider');
Route::post('/saveslider', 'SliderController@saveslider');
Route::get('/edit_slider/{id}', 'SliderController@edit_slider');
Route::post('/updateslider', 'SliderController@updateslider');
Route::get('/delete_slider/{id}', 'SliderController@delete_slider');
Route::get('/unactivate_slider/{id}', 'SliderController@unactivate_slider');
Route::get('/activate_slider/{id}', 'SliderController@activate_slider');
