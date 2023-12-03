<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\LineBotController;

/*
|--------------------------------------------------------------------------
| Line Webhook Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * Line Webhook
 * HTTP Method Post
 * https://{host}/api/line/webhook
 * 
 */
Route::post('/', [LineBotController::class, 'webhook'])->name('line.webhook');