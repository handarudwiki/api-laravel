<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('/comments',[CommentController::class,'store']);
    Route::patch('/comment/{id}',[CommentController::class,'update'])->middleware('pemilikcomment');
    Route::delete('/comment/{id}',[CommentController::class,'delete'])->middleware('pemilikcomment');
    

    Route::get('/logout',[AuthenticationController::class,'logout']);
    Route::get('/me',[AuthenticationController::class,'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/post/{id}',[PostController::class,'update'])->middleware('pemilik-postingan');
    Route::delete('/post/{id}',[PostController::class,'destroy'])->middleware('pemilik-postingan');


   
    
});

Route::get('/posts',[PostController::class, 'index']);
Route::get('/post/{id}',[PostController::class,'show']);




Route::post('/login',[AuthenticationController::class,'login'])->name('login');



