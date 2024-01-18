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
    Route::post('/', [UserController::class, 'users']);

    /**
     * 担当者情報を登録する
     * HTTP Method Put
     * https://{host}/api/user
     * 
     * @param UserRegisterRequest request リクエスト
     * @return Json
     */
    Route::put('/', [UserController::class, 'register']);

    /**
     * 担当者情報を削除する
     * HTTP Method Delete
     * https://{host}/api/user
     * 
     * @param UserDeleteRequest request リクエスト
     * @return Json
     */
    Route::delete('/', [UserController::class, 'deletes']);

    /**
     * 担当者情報を更新する
     * HTTP Method Patch
     * https://{host}/api/user/{id}
     * 
     * @param UserUpdateRequest request リクエスト
     * @param int               id      担当者情報ID
     * @return Json
     */
    Route::patch('/{id}', [UserController::class, 'update']);

    /**
     * 担当者情報を削除する
     * HTTP Method Delete
     * https://{host}/api/user/{id}
     * 
     * @param Request request リクエスト
     * @param int     id      担当者情報ID
     * @return Json
     */
    Route::delete('/{id}', [UserController::class, 'destroy'])->whereNumber('id')->name('user.destroy');
});