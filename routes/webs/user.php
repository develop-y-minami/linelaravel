<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webs\UserController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function()
{
    /**
     * 担当者ページ
     * HTTP Method Get
     * https://{host}/user
     * 
     * @param Request request リクエスト
     * @return View
     */
    Route::get('/', [UserController::class, 'index'])->name('user.index');
});