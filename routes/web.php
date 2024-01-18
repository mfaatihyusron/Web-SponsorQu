<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

Route::get('/',[SessionController::class,'index'])->middleware('isAlreadyLogin');
Route::post('/login',[SessionController::class,'login']);

Route::get('/registerform',[SessionController::class,'registerform'])->middleware('isAlreadyLogin');
Route::post('/register',[SessionController::class,'register']);

Route::post('/logout', [SessionController::class, 'logout']);

//admin routes
Route::get('/admin',[AdminController::class,'index'])->middleware('isAdmin');
Route::get('/users',[AdminController::class,'users'])->middleware('isAdmin');
Route::get('/edit-user/{id}',[AdminController::class,'edit'])->middleware('isAdmin');
Route::put('/update-user/{id}',[AdminController::class,'update'])->middleware('isAdmin');
Route::get('delete-user/{id}',[AdminController::class, 'destroy'])->middleware('isAdmin');


Route::get('/home',[HomeController::class,'index'])->middleware('isLogin');

Route::get('/posting',[HomeController::class,'posting'])->middleware('isLogin');
Route::post('/addPost/{uid}',[HomeController::class,'addPost']);  
Route::get('/write-mail/{uid_up}/{id_post}',[HomeController::class,'writeMail'])->middleware('isLogin');
Route::post('/sendMail',[HomeController::class,'sendMail'])->middleware('isLogin');
Route::get('/mail',[HomeController::class,'mail'])->middleware('isLogin');
Route::get('/viewmail/{id_mail}',[HomeController::class,'viewmail'])->middleware('isLogin');


