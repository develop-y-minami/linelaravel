<?php

namespace App\Http\Controllers\Liffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * LiffController
 * 
 */
class LiffController extends Controller
{
    /**
     * サービス提供者設定ページ
     * HTTP Method Get
     * https://{host}/liff/setting/serviceProvider
     * 
     * @param string id ID
     * @param Request request リクエスト
     * @return View
     */
    public function settingServiceProvider(Request $request)
    {
        try
        {
            return view('liffs.settingServiceProvider');
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
