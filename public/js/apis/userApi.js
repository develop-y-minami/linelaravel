/**
 * UserApi
 * 
 */
class UserApi {
    /**
     * プレフィックス
     * 
     */
    static PREFIX = 'user';
    /**
     * user/register
     * 
     */
    static PREFIX_REGISTER = UserApi.PREFIX + '/register';

    /**
     * 担当者情報を取得
     * 
     * @param {number} userType          担当者種別
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountType   担当者アカウント種別
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     */
    static async users(userType = null, serviceProviderId = null, userAccountType = null, accountId = null, name = null) {
        // パラメータを設定
        let data = {};
        if (userType !== null) data.userType = userType;
        if (serviceProviderId !== null) data.serviceProviderId = serviceProviderId;
        if (userAccountType !== null) data.userAccountType = userAccountType;
        if (accountId !== null) data.accountId = accountId;
        if (name !== null) data.name = name;

        let response = await FetchApi.post(UserApi.PREFIX, data);
        return response;
    }

    /**
     * 担当者情報を登録
     * 
     * @param {string} serviceProviderId サービス提供者情報ID
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     * @param {string} email             メールアドレス
     * @param {string} password          パスワード
     * @param {string} passwordConfirm   パスワード（確認入力）
     * @param {number} userTypeId        ユーザー種別
     * @param {number} userAccountTypeId ユーザーアカウント種別
     * @returns {object}  
     */
    static async register(serviceProviderId, accountId, name, email, password, passwordConfirm, userTypeId, userAccountTypeId) {
        // パラメータを設定
        let data = {};
        data.serviceProviderId = serviceProviderId;
        data.accountId = accountId;
        data.name = name;
        data.email = email;
        data.password = password;
        data.password_confirmation = passwordConfirm;
        data.userTypeId = userTypeId;
        data.userAccountTypeId = userAccountTypeId;

        let response = await FetchApi.post(UserApi.PREFIX_REGISTER, data);
        return response;
    }
}