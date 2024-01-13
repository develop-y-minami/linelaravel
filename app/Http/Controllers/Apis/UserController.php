<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Services\Apis\UserApiServiceInterface;
use App\Jsons\UserApis\Responses\UserRegisterResponse;
use App\Jsons\UserApis\Responses\UsersResponse;

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
     * 担当者情報を取得する
     * HTTP Method Post
     * https://{host}/api/user
     * 
     * @param Request request リクエスト
     * @return Json
     */
    public function users(Request $request)
    {
        try
        {
            // パラメータを取得
            $userTypeId = $request->input('userTypeId');
            $serviceProviderId = $request->input('serviceProviderId');
            $userAccountTypeId = $request->input('userAccountTypeId');
            $accountId = $request->input('accountId');
            $name = $request->input('name');

            // キャスト
            $userTypeId = $userTypeId === null ? null : (int)$userTypeId;
            $serviceProviderId = $serviceProviderId === null ? null : (int)$serviceProviderId;
            $userAccountTypeId = $userAccountTypeId === null ? null : (int)$userAccountTypeId;

            // 担当者情報を取得する
            $users = $this->userApiService->getUsers($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name);
            
            // レスポンスデータを生成
            $response = new UsersResponse($users);

            // HTTPステータスコード:200 
            return $this->jsonResponse($response);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * 担当者情報を登録する
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
            $userTypeId = $request->input('userTypeId');
            $serviceProviderId = $request->input('serviceProviderId');
            $userAccountTypeId = $request->input('userAccountTypeId');
            $accountId = $request->input('accountId');
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $profileImage = $request->input('profileImage');

            // キャスト
            $serviceProviderId = $serviceProviderId === null ? null : (int)$serviceProviderId;
            $userTypeId = $userTypeId === null ? null : (int)$userTypeId;
            $userAccountTypeId = $userAccountTypeId === null ? null : (int)$userAccountTypeId;

            // ユーザー情報を登録
            $user = $this->userApiService->register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password, $profileImage);

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
