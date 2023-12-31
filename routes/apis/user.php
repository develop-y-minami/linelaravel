<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\UserController;

/*
|--------------------------------------------------------------------------
| User Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * ユーザー情報を登録する
 * HTTP Method Post
 * https://{host}/api/user/register
 * 
 * @param UserRegisterRequest request リクエスト
 * @return Json
 */
Route::post('/register', [UserController::class, 'register'])->name('user.register');