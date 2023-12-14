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
 * LIFF
 * HTTP Method Get
 * https://{host}/liff/{id}
 * 
 * @param string id ID
 * @param Request request リクエスト
 * @return View
 */
Route::get('/{id}', [LiffController::class, 'liff'])->name('liff.liff');

Route::get('/', [LiffController::class, 'page'])->name('liff.page');