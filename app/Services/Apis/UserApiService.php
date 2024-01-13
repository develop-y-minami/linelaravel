<?php

namespace App\Services\Apis;

use App\Repositorys\UserRepositoryInterface;
use App\Jsons\UserApis\ServiceProvider;
use App\Jsons\UserApis\User;
use App\Jsons\UserApis\UserType;
use App\Jsons\UserApis\UserAccountType;
use Illuminate\Support\Facades\Storage;

/**
 * UserApiService
 * 
 */
class UserApiService implements UserApiServiceInterface
{
    /**
     * UserRepositoryInterface
     * 
     */
    private $userRepository;

    /**
     * __construct
     * 
     * @param UserRepositoryInterface userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 担当者情報を取得
     * 
     * @param int    userTypeId        担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return array 担当者情報
     */
    public function getUsers($userTypeId = null, $serviceProviderId = null, $userAccountTypeId = null, $accountId = null, $name = null)
    {
        // 返却データ
        $result = array();

        // サービス提供者情報を取得
        $datas = $this->userRepository->findByconditions($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name);
        foreach ($datas as $data)
        {
            // 担当者種別を設定
            $userType = new UserType($data->userType->id, $data->userType->name);
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider($data->serviceProvider->id, $data->serviceProvider->name);
            // 担当者アカウント種別を設定
            $userAccountType = new UserAccountType($data->userAccountType->id, $data->userAccountType->name);
            // 担当者情報を設定
            $user = new User(
                $data->id,
                $userType,
                $serviceProvider,
                $userAccountType,
                $data->account_id,
                $data->name,
                $data->email,
                $data->profile_image_file_path
            );

            // 配列に追加
            $result[] = $user;
        }

        return $result;
    }

    /**
     * 担当者情報を登録
     * 
     * @param int    userTypeId        担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @param string profileImage      プロフィール画像
     * @return User 担当者情報
     */
    public function register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password, $profileImage)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // 担当者情報を登録
            $result = $this->userRepository->register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password);

            // 担当者情報を取得
            $data = $this->userRepository->findById($result->id);

            // プロフィール画像を保存
            if ($profileImage != null)
            {
                // プロフィール画像を保存
                $profileImageFilePath = $this->saveProfileImageFile($userTypeId, $data->id, $serviceProviderId, $profileImage);

                // 保存先パスを設定
                $data->profile_image_file_path = $profileImageFilePath;
                $this->userRepository->save($data);
            }

            // 担当者種別を設定
            $userType = new UserType($data->userType->id, $data->userType->name);
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider($data->serviceProvider->id, $data->serviceProvider->name);
            // 担当者アカウント種別を設定
            $userAccountType = new UserAccountType($data->userAccountType->id, $data->userAccountType->name);
            // 担当者情報を設定
            $user = new User(
                $data->id,
                $userType,
                $serviceProvider,
                $userAccountType,
                $data->account_id,
                $data->name,
                $data->email,
                $data->profile_image_file_path
            );

            // コミット
            \DB::commit();

            return $user;   
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * 担当者情報を更新
     * 
     * @param int    id                担当者情報ID
     * @param int    userTypeId        担当者種別
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return User 担当者情報
     */
    public function update($id, $userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // 担当者情報を更新
            $this->userRepository->update($id, $userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email);

            // 担当者情報を取得
            $data = $this->userRepository->findById($id);

            // 担当者種別を設定
            $userType = new UserType($data->userType->id, $data->userType->name);
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider($data->serviceProvider->id, $data->serviceProvider->name);
            // 担当者アカウント種別を設定
            $userAccountType = new UserAccountType($data->userAccountType->id, $data->userAccountType->name);
            // 担当者情報を設定
            $user = new User(
                $data->id,
                $userType,
                $serviceProvider,
                $userAccountType,
                $data->account_id,
                $data->name,
                $data->email,
                $data->profile_image_file_path
            );

            // コミット
            \DB::commit();
            
            return $user;
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * プロフィール画像を保存
     * 
     * @param int    userTypeId        担当者種別
     * @param int    userId            担当者情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param string profileImageFile プロフィール画像
     * @return string 保存先パス
     */
    private function saveProfileImageFile($userTypeId, $userId, $serviceProviderId, $profileImageFile)
    {
        try
        {
            // 画像保存先の基底となるパスを取得
            $baseDirectory;
            if (\AppFacade::isOperator($userTypeId))
            {
                // operator/user
                $baseDirectory = config('user.operator_save_file_directory');
                $baseDirectory = $baseDirectory.'/user';
            }
            else
            {
                // service_provider/{service_provider_id}/user
                $baseDirectory = config('user.service_provider_save_file_directory');
                $baseDirectory = $baseDirectory.'/'.$serviceProviderId.'/user';
            }

            // パスに担当者IDを追加
            $baseDirectory = $baseDirectory.'/'.$userId.'/profile';

            // 拡張子を取得
            $extension = \FileFacade::getExtensionBase64ImageFile($profileImageFile);

            // 保存ファイルを取得
            $image = \FileFacade::decodeBase64ImageFile($profileImageFile);

            // ファイル名を生成
            $profileImageFileName = $baseDirectory.'/profile.'.$extension;

            // ファイルを保存
            Storage::disk('public')->put($profileImageFileName , $image);

            // ファイルパスを設定
            $profileImageFilePath = 'storage/'.$profileImageFileName;

            return $profileImageFilePath;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}