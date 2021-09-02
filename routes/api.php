<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories',[CategoryController::class,'categories']);
Route::delete('/delete/{id}',[CategoryController::class,'delete']);
Route::post('/savecategory', [CategoryController::class,'savecategory']);
Route::put('/edit_category/{id}',[CategoryController::class,'edit']);
Route::get('/view_by_cat/{name}',[CategoryController::class,'view_by_cat']);




    //slider
    Route::get('/sliders', 'SliderController@sliders');
    Route::get('/addslider', 'SliderController@addslider');
    Route::post('/saveslider', 'SliderController@saveslider');
    Route::get('/edit_slider/{id}', 'SliderController@edit_slider');
    Route::post('/updateslider', 'SliderController@updateslider');
    Route::get('/delete_slider/{id}', 'SliderController@delete_slider');
    Route::get('/unactivate_slider/{id}', 'SliderController@unactivate_slider');
    Route::get('/activate_slider/{id}', 'SliderController@activate_slider');


    Route::get('/aa', function(){
        return "er ";
    });



        //product
        Route::get('/addproduct', 'ProductController@addproduct');
        // Route::get('/products', 'ProductController@products');
        Route::get('/products',[ProductController::class,'products']);
        Route::post('/saveproduct', 'ProductController@saveproduct');
        Route::get('/edit_product/{id}', 'ProductController@editproduct');
        Route::post('/updateproduct', 'ProductController@updateproduct');
        Route::get('/delete_product/{id}', 'ProductController@delete_product');
        Route::get('/activate_product/{id}', 'ProductController@activate_product');
        Route::get('/unactivate_product/{id}', 'ProductController@unactivate_product');


