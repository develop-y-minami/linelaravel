<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;

/**
 * UserController
 * 
 */
class UserController extends Controller
{
    /**
     * ユーザー情報を登録する
     * HTTP Method Post
     * https://{host}/api/user/register
     * 
     * @param UserRegisterRequest request リクエスト
     * @return Json
     */
    public function register(UserRegisterRequest $request)
    {
        try
        {
            // パラメータを取得

            // ユーザー情報を登録

            // HTTPステータスコード:200 
            return $this->jsonResponse();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
