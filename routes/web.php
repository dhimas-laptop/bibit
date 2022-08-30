<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [AppController::class , 'index']);
Route::get('/login', [LoginController::class , 'index']);
Route::get('/list-bibit', [AppController::class , 'list']);
Route::get('/API/bibit', [ApiController::class , 'index']);
Route::post('/API/bibit', [ApiController::class , 'store']);
Route::post('/API/bibit/update/{id}', [ApiController::class , 'update']);
Route::post('/API/bibit/delete/{id}', [ApiController::class , 'destroy']);