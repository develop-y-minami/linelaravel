<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\LineMessagingApiController;

/*
|--------------------------------------------------------------------------
| Line Messaging Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * ボットの情報を取得する
 * HTTP Method Get
 * https://{host}/api/line/messaging/api/bot/info
 * 
 * @param Request request リクエスト
 * @return Json
 */
Route::get('/bot/info', [LineMessagingApiController::class, 'botInfo']);