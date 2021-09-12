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
Route::get('/shop', 'ClientController@shop')->name('shop');
Route::get('/cart', 'ClientController@cart')->name('cart');
Route::get('/checkout', 'ClientController@checkout')->name('checkout')->middleware('auth');
Route::get('/login', 'ClientController@login')->name('login');
Route::get('/signup', 'ClientController@signup')->name('signup');
Route::post('/updateqty', 'ClientController@updateqty')->name('updateqty');
Route::get('/removeitem/{id}', 'ClientController@removeitem')->name('removeitem');
Route::post('postcheckout', 'ClientController@postcheckout')->name('postcheckout');
Route::get('/orders/{id}/delivered', 'ClientController@delivered');

Route::post('/createaccount', 'ClientController@createaccount');
Route::post('/accsesaccount', 'ClientController@accsesaccount');
Route::get('/logout', 'ClientController@logout');
Route::get('/contactus', 'ClientController@contactus')->name('contactus');
Route::post('/datacontact', 'ClientController@datacontact');
Route::get('/profile', 'ClientController@profile')->name('profile')->middleware('auth');


Route::get('/about', 'ClientController@about')->name('about'); //------------about route--------------------------
Route::get('/privacypolicy', 'ClientController@privacypolicy')->name('privacypolicy'); //------------privacypolicy route-------------
Route::get('/terms', 'ClientController@terms')->name('terms'); //------------terms route-------------
Route::get('/shipping', 'ClientController@shipping')->name('shipping'); //------------shipping route-------------
Route::get('/returns', 'ClientController@returns')->name('returns'); //------------returns route-------------






//admin group
Route::group(['prefix' => 'admin' , 'middleware' => ['can:isAdmin']], function () {
    Route::get('/view_pdf/{id}', 'PdfController@viewpdf');


    Route::get('/', 'AdminController@dashboard');
    Route::get('/orders', 'AdminController@orders');
    Route::get('/new_orders', 'AdminController@new_orders');
    Route::get('/delivered/{id}', 'AdminController@delivered');
    

    // ----------------- clients route-------------------------------
    Route::get('/clients', 'AdminController@clients');
    Route::get('/activate_client/{id}', 'AdminController@activate_client');
    Route::get('/unactivate_client/{id}', 'AdminController@unactivate_client');
    Route::get('/usersmessages', 'AdminController@usersmessages');
    Route::get('/delete_message/{id}', 'AdminController@delete_message');

    // categories
    Route::get('/addcategory', 'CategoryController@addcategory');
    Route::post('/savecategory', 'CategoryController@savecategory');
    Route::get('/categories', 'CategoryController@categories');
    Route::get('/edit_category/{id}', 'CategoryController@edit');
    Route::post('/updatecategory', 'CategoryController@updatecategory');
    Route::get('/delete/{id}', 'CategoryController@delete');
    Route::get('/view_by_cat/{name}', 'CategoryController@view_by_cat');


    //product
    Route::get('/addproduct', 'ProductController@addproduct');
    Route::get('/products', 'ProductController@products');
    Route::post('/saveproduct', 'ProductController@saveproduct');
    Route::get('/edit_product/{id}', 'ProductController@editproduct');
    Route::post('/updateproduct', 'ProductController@updateproduct');
    Route::get('/delete_product/{id}', 'ProductController@delete_product');
    Route::get('/activate_product/{id}', 'ProductController@activate_product');
    Route::get('/unactivate_product/{id}', 'ProductController@unactivate_product');




    //slider
    Route::get('/sliders', 'SliderController@sliders');
    Route::get('/addslider', 'SliderController@addslider');
    Route::post('/saveslider', 'SliderController@saveslider');
    Route::get('/edit_slider/{id}', 'SliderController@edit_slider');
    Route::post('/updateslider', 'SliderController@updateslider');
    Route::get('/delete_slider/{id}', 'SliderController@delete_slider');
    Route::get('/unactivate_slider/{id}', 'SliderController@unactivate_slider');
    Route::get('/activate_slider/{id}', 'SliderController@activate_slider');

    Route::get('/notifications', 'NotificationController@index');
    Route::get('/notifications/{id}', 'NotificationController@show');

    Route::get('orders/banned_orders', 'OrderController@banned');
    Route::get('orders/in_progress', 'OrderController@in_progress');
    Route::get('orders/shipped', 'OrderController@shipped');
    Route::get('orders/delivered', 'OrderController@delivered');
    Route::get('orders/{id}/up', 'OrderController@up');
});


// ----------------- clients route-------------------------------



/* addcategory*/
Route::get('/view_by_cat/{name}', 'CategoryController@view_by_cat');


/* product*/

Route::get('/addToCart/{id}', 'ProductController@addToCart');
Route::fallback(function () {

    return view('client.notFound');

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ClientController@search')->name('search');