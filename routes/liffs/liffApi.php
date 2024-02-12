<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Liffs\LiffApiController;

/*
|--------------------------------------------------------------------------
| Liff Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('liff')->group(function()
{
    /**
     * アクセストークンを検証する
     * アクセストークンの検証はMiddlewareで実行されこのメソッドでは常に成功をレスポンス
     * HTTP Method Post
     * https://{host}/liff/api/verify/accessToken
     * 
     * @param Request request リクエスト
     * @return Json
     */
    Route::post('/verify/accessToken', [LiffApiController::class, 'verifyAccessToken']);
    
    /**
     * サービス提供者情報.提供者IDを確認する
     * HTTP Method Post
     * https://{host}/liff/api/verify/serviceProvider
     * 
     * @param VerifyServiceProviderRequest request リクエスト
     * @return Json
     */
    Route::post('/verify/serviceProvider', [LiffApiController::class, 'verifyServiceProvider']);

    /**
     * サービス提供者情報を更新する
     * HTTP Method Patch
     * https://{host}/liff/api/line/{id}/serviceProvider
     * 
     * @param LineServiceProviderUpdateRequest request リクエスト
     * @param int id LINE情報ID
     * @return Json
     */
    Route::patch('/line/{id}/serviceProvider', [LiffApiController::class, 'updateServiceProvider']);
});