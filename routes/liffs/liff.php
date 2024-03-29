<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Liffs\LiffController;

/*
|--------------------------------------------------------------------------
| Liff Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * サービス提供者設定ページ
 * HTTP Method Get
 * https://{host}/liff/setting/serviceProvider
 * 
 * @param Request request リクエスト
 * @return View
 */
Route::get('/setting/serviceProvider', [LiffController::class, 'settingServiceProvider']);