<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\LineController;

/*
|--------------------------------------------------------------------------
| Line Routes
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
 * https://{host}/api/line/bot/info
 * 
 */
Route::get('/bot/info', [LineController::class, 'botInfo'])->name('line.bot.info');