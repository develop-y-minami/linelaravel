<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Services\Apis\UserApiServiceInterface;
use App\Jsons\UserApis\Responses\UserRegisterResponse;

/**
 * UserController
 * 
 */
class UserController extends Controller
{
    /**
     * UserApiService
     * 
     */
    private $userApiService;

    /**
     * __construct
     * 
     * @param UserApiServiceInterface userApiService
     */
    public function __construct(UserApiServiceInterface $userApiService)
    {
        $this->userApiService = $userApiService;
    }

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
            $serviceProviderId = $request->input('serviceProviderId');
            $accountId = $request->input('accountId');
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $userTypeId = $request->input('userTypeId');
            $userAccountTypeId = $request->input('userAccountTypeId');

            // キャスト
            $serviceProviderId = $serviceProviderId === null ? null : (int)$serviceProviderId;
            $userTypeId = $userTypeId === null ? null : (int)$userTypeId;
            $userAccountTypeId = $userAccountTypeId === null ? null : (int)$userAccountTypeId;

            // ユーザー情報を登録
            $user = $this->userApiService->register($serviceProviderId, $accountId, $name, $email, $password, $userTypeId, $userAccountTypeId);

            // レスポンスデータを生成
            $response = new UserRegisterResponse($user);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
