<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\ClientController;

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

//category
Route::get('/categories', [CategoryController::class, 'categories']);
Route::delete('/delete_category/{id}', [CategoryController::class, 'delete']);
Route::post('/savecategory', [CategoryController::class, 'savecategory']);
Route::put('/edit_category/{id}', [CategoryController::class, 'edit']);
Route::get('/view_by_cat/{name}', [CategoryController::class, 'view_by_cat']);




//slider
Route::get('/sliders', [SliderController::class, 'sliders']);
Route::get('/showsliders/{id}', [SliderController::class, 'showsliders']);
Route::delete('/delete_slider/{id}', [SliderController::class, 'delete_slider']);
Route::post('/saveslider', [SliderController::class, 'saveslider']);

Route::post('/edit_slider/{id}', [SliderController::class, 'edit_slider']);



//product controller
Route::get('/products', [ProductController::class, 'products']);
Route::put('/saveproduct/{id}', [ProductController::class, 'saveproduct']);
Route::put('/edit_product/{id}', [ProductController::class, 'editproduct']); //->1
Route::delete('/delete_product/{id}', [ProductController::class, 'delete_product']);
Route::get('/activate_product/{id}', [ProductController::class, 'activate_product']);
Route::get('/unactivate_product/{id}', [ProductController::class, 'unactivate_product']);
Route::get('/addToCart/{id}', 'ProductController@addToCart');  //->2

//***********************    start of clinet controller  *****************************
Route::group(['namespace' => 'Api'], function () {
    
});//->middleware('auth:sanctum')
Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::get('/cart', [ClientController::class,'cart']);
    Route::get('/shop', [ClientController::class, 'shop']);
    Route::get('/',[ClientController::class, 'home']);

});
/* ->middleware('auth:sanctum') */;
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


/* Route::get('/about', 'ClientController@about'); 
Route::get('/privacypolicy', 'ClientController@privacypolicy');
Route::get('/terms', 'ClientController@terms'); 
Route::get('/shipping', 'ClientController@shipping'); 
Route::get('/returns', 'ClientController@returns'); */


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

//***********************    end of clinet controller    ******************************
