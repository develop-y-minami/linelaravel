<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\UserController;

/*
|--------------------------------------------------------------------------
| User Api Routes
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
     * 担当者情報を取得する
     * HTTP Method Post
     * https://{host}/api/user
     * 
     * @param Request request リクエスト
     * @return Json
     */
    Route::post('/', [UserController::class, 'users'])->name('users');

    /**
     * 担当者情報を登録する
     * HTTP Method Post
     * https://{host}/api/user/register
     * 
     * @param UserRegisterRequest request リクエスト
     * @return Json
     */
    Route::post('/register', [UserController::class, 'register'])->name('user.register');

    /**
     * 担当者情報を更新する
     * HTTP Method Patch
     * https://{host}/api/user/{id}
     * 
     * @param UserUpdateRequest request リクエスト
     * @param int               id      担当者情報ID
     * @return Json
     */
    Route::patch('/{id}', [UserController::class, 'update'])->name('user.update');
});