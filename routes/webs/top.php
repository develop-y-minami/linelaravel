<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webs\TopController;

/*
|--------------------------------------------------------------------------
| Top Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * トップページ
 * HTTP Method Get
 * https://{host}
 * 
 */
Route::get('/', [TopController::class, 'index'])->name('top.index');