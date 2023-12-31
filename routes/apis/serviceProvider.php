<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\ServiceProviderController;

/*
|--------------------------------------------------------------------------
| ServiceProvider Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * サービス提供者情報を取得する
 * HTTP Method Post
 * https://{host}/api/serviceProvider
 * 
 * @param Request request リクエスト
 * @return Json
 */
Route::post('/', [ServiceProviderController::class, 'serviceProviders'])->name('serviceProviders');

/**
 * サービス提供者情報を登録する
 * HTTP Method Post
 * https://{host}/api/serviceProvider/register
 * 
 * @param ServiceProviderRegisterRequest request リクエスト
 * @return Json
 */
Route::post('/register', [ServiceProviderController::class, 'register'])->name('serviceProvider.register');

/**
 * サービス提供者情報を更新する
 * HTTP Method Patch
 * https://{host}/api/serviceProvider/{id}
 * 
 * @param ServiceProviderUpdateRequest request リクエスト
 * @param int                            id      サービス提供者情報ID
 * @return Json
 */
Route::patch('/{id}', [ServiceProviderController::class, 'update'])->name('serviceProvider.update');

/**
 * サービス提供者情報を削除する
 * HTTP Method Delete
 * https://{host}/api/serviceProvider/{id}
 * 
 * @param Request request リクエスト
 * @param int     id      サービス提供者情報ID
 * @return Json
 */
Route::delete('/{id}', [ServiceProviderController::class, 'destroy'])->whereNumber('id')->name('serviceProvider.destroy');