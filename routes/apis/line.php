<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\LineController;

/*
|--------------------------------------------------------------------------
| Line Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * LINE通知情報を取得する
 * HTTP Method Post
 * https://{host}/api/line/notice
 * 
 * @param Request request リクエスト
 * @return Json
 */
Route::post('/notice', [LineController::class, 'notice'])->name('line.notice');