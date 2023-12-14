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
     * LIFF
     * HTTP Method Get
     * https://{host}/liff/{id}
     * 
     * @param string id ID
     * @param Request request リクエスト
     * @return View
     */
    public function liff(Request $request, $id) {
        try
        {
            switch ((int)$id)
            {
                case \LiffPageType::USER_REGISTER :
                    return $this->userRegisterPage();
                    break;
            }

            return view('pages.top')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function page(Request $request) {
        return view('liffs.userRegister')->with('data', []);
    }

    /**
     * ユーザー登録ページ
     * 
     * @return View
     */
    private function userRegisterPage()
    {
        try
        {
            return view('liffs.userRegister')->with('data', []);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
