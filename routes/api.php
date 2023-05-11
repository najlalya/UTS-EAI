<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/hotels', [\App\Http\Controllers\HotelController::class , 'index']);
Route::post('/hotels', [\App\Http\Controllers\HotelController::class , 'store']);
Route::get('/hotels/{id}', [\App\Http\Controllers\HotelController::class , 'show']);
Route::put('/hotels/{id}', [\App\Http\Controllers\HotelController::class , 'update']);
Route::delete('/hotels/{id}', [\App\Http\Controllers\HotelController::class , 'destroy']);
Route::get('/hotels/city/{city_location}', [\App\Http\Controllers\HotelController::class , 'search']);
Route::get('/hotels/name/{name}', [\App\Http\Controllers\HotelController::class , 'searchName']);
