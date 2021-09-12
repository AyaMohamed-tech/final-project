<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AdminController;


use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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


Route::group(['namespace' => 'Api'], function () {
    
});

Route::group(['middleware' => ['auth:sanctum' ,'can:isAdmin']], static function () {
 

    /**************admin************ */

    //category
    Route::get('/categories', [CategoryController::class, 'categories']);
    Route::delete('/delete_category/{id}', [CategoryController::class, 'delete']);
    Route::post('/savecategory', [CategoryController::class, 'savecategory']);
    Route::post('/edit_category/{id}', [CategoryController::class, 'edit']);
    Route::get('/view_by_cat/{name}', [CategoryController::class, 'view_by_cat']);

    //slider
    Route::get('/sliders', [SliderController::class, 'sliders']);
    Route::get('/showsliders/{id}', [SliderController::class, 'showsliders']);
    Route::delete('/delete_slider/{id}', [SliderController::class, 'delete_slider']);
    Route::post('/saveslider', [SliderController::class, 'saveslider']);
    Route::post('/edit_slider/{id}', [SliderController::class, 'edit_slider']);


    //product controller
    Route::get('/products', [ProductController::class, 'products']);
    Route::post('/saveproduct', [ProductController::class, 'saveproduct']);
    Route::post('/edit_product/{id}', [ProductController::class, 'editproduct']); //->1
    Route::delete('/delete_product/{id}', [ProductController::class, 'delete_product']);
    Route::post('/activate_product/{id}', [ProductController::class, 'activate_product']);
    Route::post('/unactivate_product/{id}', [ProductController::class, 'unactivate_product']);



    Route::get('/orders', [AdminController::class, 'orders']);
    Route::get('/new_orders', [AdminController::class, 'new_orders']);
    Route::get('/delivered/{id}',  [AdminController::class, 'delivered']);


    
    Route::get('/clients',[AdminController::class, 'clients']);
    //Route::get('/activate_client/{id}', [AdminController::class, 'activate_client']);
    //Route::get('/unactivate_client/{id}', [AdminController::class, 'unactivate_client']);
    Route::get('/usersmessages',[AdminController::class, 'usersmessages']);
    Route::delete('/delete_message/{id}', [AdminController::class, 'delete_message']);


});

 // ----------------- clients route-------------------------------
Route::get('/',[ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop']);

Route::group(['middleware' => ['auth:sanctum' ,'can:isUser']], static function () {

   // Route::get('/cart', [ClientController::class,'cart']);// return 1   
    Route::get('/profile', [ClientController::class, 'profile']); 
});


Route::get('/addToCart/{id}', 'ProductController@addToCart');  //->2

Route::post('/datacontact', 'ClientController@datacontact');






Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});


