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
 * https://{host}/api/line/notices
 * 
 * @param Request request リクエスト
 * @return Json
 */
Route::post('/notices', [LineController::class, 'notices'])->name('line.notices');

/**
 * LINE情報を取得する
 * HTTP Method Post
 * https://{host}/api/line/lines
 * 
 * @param Request request リクエスト
 * @return Json
 */
Route::post('/lines', [LineController::class, 'lines'])->name('line.lines');

/**
 * LINE担当者情報を設定する
 * HTTP Method Post
 * https://{host}/api/line/{id}/user/setting
 * 
 * @param LineUserSettingRequest request リクエスト
 * @param string  id      ID
 * @return Json
 */
Route::post('/{id}/user/setting', [LineController::class, 'userSetting'])->whereNumber('id')->name('line.user.setting');