<?php

namespace App\Http\Controllers\Liffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Objects\Liffs\SettingServiceProvider;

/**
 * LiffController
 * 
 * LIFF
 * 
 */
class LiffController extends Controller
{
    /**
     * サービス提供者設定ページ
     * HTTP Method Get
     * https://{host}/liff/setting/serviceProvider
     * 
     * @param Request request リクエスト
     * @return View
     */
    public function settingServiceProvider(Request $request)
    {
        try
        {
            // パラメータを取得
            $liffPageId = $request->input('liffPageId');
            $lineId = $request->input('lineId');

            // 返却データに設定
            $result = new SettingServiceProvider($liffPageId, $lineId);

            return view('liffs.settingServiceProvider')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
