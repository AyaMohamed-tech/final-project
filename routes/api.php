<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

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


