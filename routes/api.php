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

//Article routes
Route::prefix('/article')->group(function(){
    Route::get('/',[\App\Http\Controllers\Articles\ArticleController::class,'get']);
    Route::post('/filter',[\App\Http\Controllers\Articles\ArticleController::class,'filter']);
    Route::post('/add',[\App\Http\Controllers\Articles\ArticleAddController::class,'post']);
});
//Tags routes
Route::get('/tags',[\App\Http\Controllers\Tags\TagsController::class,'get']);
//Authentication routes
Route::post('/register',[\App\Http\Controllers\Authentication\RegisterController::class,'post']);
Route::post('/login',[\App\Http\Controllers\Authentication\LoginController::class,'post']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/auth',[\App\Http\Controllers\Authentication\AuthController::class,'get']);
    Route::get('/logout',[\App\Http\Controllers\Authentication\LogoutController::class,'get']);
});
