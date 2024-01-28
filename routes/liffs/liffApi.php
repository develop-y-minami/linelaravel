<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Liffs\LiffApiController;

/*
|--------------------------------------------------------------------------
| Liff Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * サービス提供者情報.提供者IDを確認する
 * HTTP Method Post
 * https://{host}/liff/api/verify/serviceProvider
 * 
 * @param VerifyServiceProviderRequest request リクエスト
 * @return Json
 */
Route::post('/verify/serviceProvider', [LiffApiController::class, 'verifyServiceProvider']);