<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webs\ServiceProviderController;

/*
|--------------------------------------------------------------------------
| ServiceProvider Routes
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
     * サービス提供者ページ
     * HTTP Method Get
     * https://{host}/serviceProvider
     * 
     * @param Request request リクエスト
     * @return View
     */
    Route::get('/', [ServiceProviderController::class, 'serviceProviders'])->name('serviceProviders');

    /**
     * サービス提供者ページ
     * HTTP Method Get
     * https://{host}/serviceProvider/{id}
     * 
     * @param Request request リクエスト
     * @param int id ID
     * @return View
     */
    Route::get('/{id}', [ServiceProviderController::class, 'serviceProvider'])->whereNumber('id')->name('serviceProvider');
});