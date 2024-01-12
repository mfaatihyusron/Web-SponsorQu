<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
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

Route::get('contacts',[ContactController::class, 'index'])->middleware('isLogin');

Route::get('add-contact',[ContactController::class, 'create']);
Route::post('add-contact',[ContactController::class, 'store']);

Route::get('edit-contact/{id}',[ContactController::class, 'edit']);

Route::put('update-contact/{id}',[ContactController::class, 'update']);

Route::get('delete-contact/{id}',[ContactController::class, 'destroy']);

Route::get('/',[SessionController::class,'index']);
Route::post('/login',[SessionController::class,'login']);

Route::get('/registerform',[SessionController::class,'registerform']);
Route::post('/register',[SessionController::class,'register']);

Route::post('/logout', [SessionController::class, 'logout']);

Route::get('/home',[HomeController::class,'index'])->middleware('isLogin');

Route::get('/posting',[HomeController::class,'posting'])->middleware('isLogin');
Route::post('/addPost/{uid}',[HomeController::class,'addPost']);  


