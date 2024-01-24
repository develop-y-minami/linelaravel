<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * UserRepository
 * 
 * 担当者情報
 * 
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * 全担当者情報を取得
     * 
     * @return Collection 担当者情報
     */
    public function getAll()
    {
        $query = User::query();

        $query->with([
            'userType',
            'serviceProvider',
            'userAccountType',
        ]);

        if (\AppFacade::loginUserIsOperatorUser())
        {
            // ログイン担当者が運用者（一般）の場合は運用者の管理者は取得しない
            $query->whereNot(function($query)
            {
                $query->whereUserTypeId(1);
                $query->whereUserAccountTypeId(2);
            });
        }

        $query->orderBy('user_type_id')->orderBy('service_provider_id')->orderBy('user_account_type_id')->orderBy('account_id');

        return $query->get();
    }

    /**
     * ID検索
     * 
     * @param int id ID
     * @return User ユーザー情報
     */
    public function findById($id)
    {
        return User::with([
            'userType',
            'serviceProvider',
            'userAccountType',
        ])->find($id);
    }

    /**
     * 複数ID検索
     * 
     * @param array ids ID
     * @return Collection 担当者情報
     */
    public function findByIds($ids)
    {
        return User::with([
            'userType',
            'serviceProvider',
            'userAccountType',
        ])->whereIn('id', $ids)->get();
    }

    /**
     * サービス提供者情報ID検索
     * 
     * @param int serviceProviderId サービス提供者情報ID
     * @return Collection 担当者情報
     */
    public function findByServiceProviderId($serviceProviderId)
    {
        return User::whereServiceProviderId($serviceProviderId)->orderBy('user_account_type_id')->orderBy('account_id')->get();
    }

    /**
     * 担当者種別情報ID検索
     * 
     * @param int userTypeId 担当者種別情報ID
     * @return Collection 担当者情報
     */
    public function findByUserTypeId($userTypeId)
    {
        return User::whereUserTypeId($userTypeId)->orderBy('service_provider_id')->orderBy('user_account_type_id')->orderBy('account_id')->get();
    }

    /**
     * 条件指定検索
     * 
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @return Collection 担当者情報
     */
    public function findByconditions($userTypeId = null, $serviceProviderId = null, $userAccountTypeId = null, $accountId = null, $name = null)
    {
        $query = User::query();

        $query->with([
            'userType',
            'serviceProvider',
            'userAccountType',
        ]);

        // 担当者種別情報ID
        if ($userTypeId !== null) $query->whereUserTypeId($userTypeId);

        // サービス提供者情報ID
        if ($serviceProviderId !== null) $query->whereServiceProviderId($serviceProviderId);

        // 担当者アカウント種別情報ID
        if ($userAccountTypeId !== null) $query->whereUserAccountTypeId($userAccountTypeId);

        // アカウントID
        if ($accountId !== null) $query->whereAccountId($accountId);

        // 名前
        if ($name != null) $query->where('name', 'LIKE', "$name%");

        if (\AppFacade::loginUserIsOperatorUser())
        {
            // ログイン担当者が運用者（一般）の場合は運用者の管理者は取得しない
            $query->whereNot(function($query)
            {
                $query->whereUserTypeId(\UserType::OPERATOR);
                $query->whereUserAccountTypeId(\UserAccountType::ADMIN);
            });
        }
        else if (\AppFacade::loginUserIsServiceProviderUser())
        {
            // ログイン担当者がサービス提供者（一般）の場合はサービス提供者の管理者は取得しない
            $query->whereNot(function($query)
            {
                $query->whereUserTypeId(\UserType::SERVICE_PROVIDER);
                $query->whereUserAccountTypeId(\UserAccountType::ADMIN);
            });
        }

        $query->orderBy('user_type_id')->orderBy('service_provider_id')->orderBy('user_account_type_id')->orderBy('account_id');

        return $query->get();
    }

    /**
     * 登録
     * 
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @param string password          パスワード
     * @return User 担当者情報
     */
    public function register($userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email, $password)
    {
        return User::create([
            'service_provider_id' => $serviceProviderId,
            'account_id' => $accountId,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'user_type_id' => $userTypeId,
            'user_account_type_id' => $userAccountTypeId
        ]);
    }

    /**
     * 更新
     * 
     * @param int    id                ID
     * @param int    userTypeId        担当者種別情報ID
     * @param int    serviceProviderId サービス提供者情報ID
     * @param int    userAccountTypeId 担当者アカウント種別情報ID
     * @param string accountId         アカウントID
     * @param string name              名前
     * @param string email             メールアドレス
     * @return int 更新数
     */
    public function update($id, $userTypeId, $serviceProviderId, $userAccountTypeId, $accountId, $name, $email)
    {
        return User::where('id', $id)->update([
            'service_provider_id' => $serviceProviderId,
            'account_id' => $accountId,
            'name' => $name,
            'email' => $email,
            'user_type_id' => $userTypeId,
            'user_account_type_id' => $userAccountTypeId
        ]);
    }

    /**
     * 保存
     * 
     * @param User user 担当者情報
     * @return bool 結果
     */
    public function save($user)
    {
        return $user->save();
    }

    /**
     * 削除
     * 
     * @param int id ID
     * @return int 削除件数
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }

    /**
     * 複数削除
     * 
     * @param array id ID
     * @return int 削除件数
     */
    public function deletes($ids)
    {
        return User::whereIn('id', $ids)->delete();
    }
}