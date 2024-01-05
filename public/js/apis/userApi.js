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
     * ユーザー情報を登録
     * 
     * @param {string} serviceProviderId サービス提供者ID
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