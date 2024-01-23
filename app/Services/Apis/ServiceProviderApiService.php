<?php

namespace App\Services\Apis;

use App\Repositorys\LineTransitionRepositoryInterface;
use App\Repositorys\ServiceProviderRepositoryInterface;
use App\Repositorys\UserRepositoryInterface;
use App\Jsons\ServiceProviderApis\ServiceProvider;
use Illuminate\Support\Facades\Storage;

/**
 * ServiceProviderApiService
 * 
 */
class ServiceProviderApiService implements ServiceProviderApiServiceInterface
{
    /**
     * LineTransitionRepositoryInterface
     * 
     */
    private $lineTransitionRepository;
    /**
     * ServiceProviderRepositoryInterface
     * 
     */
    private $serviceProviderRepository;
    /**
     * UserRepositoryInterface
     * 
     */
    private $userRepository;

    /**
     * __construct
     * 
     * @param LineTransitionRepositoryInterface  lineTransitionRepository
     * @param ServiceProviderRepositoryInterface serviceProviderRepository
     * @param UserRepositoryInterface            userRepository
     */
    public function __construct(
        LineTransitionRepositoryInterface $lineTransitionRepository,
        ServiceProviderRepositoryInterface $serviceProviderRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->serviceProviderRepository = $serviceProviderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * サービス提供者情報を取得
     * 
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return array サービス提供者情報
     */
    public function getServiceProviders(
        $providerId = null,
        $name = null,
        $useStartDateTime = null,
        $useEndDateTime = null,
        $useStop = null
    )
    {
        // 返却データ
        $result = array();

        // サービス提供者情報を取得
        $datas = $this->serviceProviderRepository->findByconditions($providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);
        foreach ($datas as $data)
        {
            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider(
                $data->id,
                $data->provider_id,
                $data->name,
                $data->use_start_date_time,
                $data->use_end_date_time,
                $data->use_stop,
                \ServiceProviderUseStop::getName($data->use_stop),
                $data->created_at,
                $data->updated_at
            );

            // 配列に追加
            $result[] = $serviceProvider;
        }

        return $result;
    }

    /**
     * LINE数推移情報を取得
     * 
     * @param int    id                 サービス提供者情報ID
     * @param string transitionDateFrom 日付：FROM
     * @param string transitionDateTo   日付：TO
     * @return array LINE数推移情報
     */
    public function getLineTransitions($id, $transitionDateFrom = null, $transitionDateTo  = null)
    {
        // 返却データ
        $result = array();

        // LINE数推移情報を取得
        $datas = $this->lineTransitionRepository->findByServiceProvider($id, $transitionDateFrom, $transitionDateTo);
        foreach ($datas as $data)
        {
            // LINE数推移情報を取得
            
        }

        return $result;
    }

    /**
     * サービス提供者情報を登録
     * 
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @return ServiceProvider サービス提供者情報
     */
    public function register($providerId, $name, $useStartDateTime, $useEndDateTime)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // サービス提供者情報を登録
            $data = $this->serviceProviderRepository->register($providerId, $name, $useStartDateTime, $useEndDateTime);

            // サービス提供者情報を取得
            $data = $this->serviceProviderRepository->findById($data->id);

            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider(
                $data->id,
                $data->provider_id,
                $data->name,
                $data->use_start_date_time,
                $data->use_end_date_time,
                $data->use_stop,
                \ServiceProviderUseStop::getName($data->use_stop),
                $data->created_at,
                $data->updated_at
            );

            // コミット
            \DB::commit();

            return $serviceProvider;
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * サービス提供者情報を更新
     * 
     * @param int    id               サービス提供者情報ID
     * @param string providerId       サービス提供者ID
     * @param string name             サービス提供者名
     * @param string useStartDateTime サービス利用開始日
     * @param string useEndDateTime   サービス利用終了日
     * @param bool   useStop          サービス利用状態
     * @return ServiceProvider サービス提供者情報
     */
    public function update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // サービス提供者情報を更新
            $this->serviceProviderRepository->update($id, $providerId, $name, $useStartDateTime, $useEndDateTime, $useStop);

            // サービス提供者情報を取得
            $data = $this->serviceProviderRepository->findById($id);

            // サービス提供者情報を設定
            $serviceProvider = new ServiceProvider(
                $data->id,
                $data->provider_id,
                $data->name,
                $data->use_start_date_time,
                $data->use_end_date_time,
                $data->use_stop,
                \ServiceProviderUseStop::getName($data->use_stop),
                $data->created_at,
                $data->updated_at
            );

            // コミット
            \DB::commit();
            
            return $serviceProvider;
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * サービス提供者情報を削除
     * 
     * @param int id サービス提供者情報ID
     * @return int 削除件数
     */
    public function destroy($id)
    {
        // トランザクション開始
        \DB::beginTransaction();

        try
        {
            // サービス提供者情報を削除
            $result = $this->serviceProviderRepository->destroy($id);

            // 担当者ID
            $userIds = array();

            // 担当者情報を取得
            $users = $this->userRepository->findByServiceProviderId($id);
            foreach ($users as $user)
            {
                // 担当者IDを保持
                $userIds[] = $user->id;
            }

            if (count($userIds) > 0)
            {
                // 担当者情報を削除
                $this->userRepository->deletes($userIds);
            }

            // ファイル保存先ディレクトリを削除
            $this->deleteDirectory($id);

            // コミット
            \DB::commit();

            return $result;
        }
        catch (\Exception $e)
        {
            // ロールバック
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * サービス提供者ファイル保存用ディレクトリを削除
     * 
     * @param int id サービス提供者情報ID
     */
    private function deleteDirectory($id)
    {
        // ファイル保存先でディレクトリの基底を取得
        $baseDirectory = config('user.service_provider_save_file_directory');

        // サービス提供者IDを結合
        $saveFilePath = $baseDirectory.'/'.$id;

        // ファイル保存先ディレクトリを削除
        Storage::disk('public')->deleteDirectory($saveFilePath);
    }
}