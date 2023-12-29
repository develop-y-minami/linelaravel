<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\ServiceProviderController;

/*
|--------------------------------------------------------------------------
| ServiceProvider Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * サービス提供者情報を登録する
 * HTTP Method Post
 * https://{host}/api/serviceProvider/register
 * 
 * @param Request request リクエスト
 * @return Json
 */
Route::post('/register', [ServiceProviderController::class, 'register'])->name('serviceProvider.register');