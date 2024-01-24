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
     * 担当者情報を取得
     * 
     * @param {number} userTypeId        担当者種別情報ID
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountTypeId 担当者アカウント種別情報ID
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     */
    static async users({userTypeId = null, serviceProviderId = null, userAccountTypeId = null, accountId = null, name = null}) {
        // パラメータを設定
        let data = {};
        if (userTypeId !== null) data.userTypeId = userTypeId;
        if (serviceProviderId !== null) data.serviceProviderId = serviceProviderId;
        if (userAccountTypeId !== null) data.userAccountTypeId = userAccountTypeId;
        if (accountId !== null) data.accountId = accountId;
        if (name !== null) data.name = name;

        let response = await FetchApi.post(UserApi.PREFIX, data);
        return response;
    }

    /**
     * 担当者情報を登録
     * 
     * @param {number} userTypeId        担当者種別情報ID
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountTypeId 担当者アカウント種別情報ID
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     * @param {string} email             メールアドレス
     * @param {string} password          パスワード
     * @param {string} passwordConfirm   パスワード（確認入力）
     * @param {string} profileImage      プロフィール画像
     * @returns {object}  
     */
    static async register(userTypeId, serviceProviderId, userAccountTypeId, accountId, name, email, password, passwordConfirm, profileImage) {
        // パラメータを設定
        let data = {};
        data.userTypeId = userTypeId;
        data.serviceProviderId = serviceProviderId;
        data.userAccountTypeId = userAccountTypeId;
        data.accountId = accountId;
        data.name = name;
        data.email = email;
        data.password = password;
        data.password_confirmation = passwordConfirm;
        data.profileImage = profileImage;

        let response = await FetchApi.put(UserApi.PREFIX, data);
        return response;
    }

    /**
     * 担当者情報を更新
     * 
     * @param {number} id                ID
     * @param {number} userTypeId        担当者種別情報ID
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountTypeId 担当者アカウント種別情報ID
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     * @param {string} email             メールアドレス
     * @returns {object}  
     */
    static async update(id, userTypeId, serviceProviderId, userAccountTypeId, accountId, name, email) {
        let url = UserApi.PREFIX + '/' + id;

        // パラメータを設定
        let data = {};
        data.id = id;
        data.userTypeId = userTypeId;
        data.serviceProviderId = serviceProviderId;
        data.userAccountTypeId = userAccountTypeId;
        data.accountId = accountId;
        data.name = name;
        data.email = email;

        let response = await FetchApi.patch(url, data);
        return response;
    }

    /**
     * 担当者情報を削除
     * 
     * @param {number} id 担当者情報ID
     * @returns {object}  
     */
    static async destroy(id) {
        let url = UserApi.PREFIX + '/' + id;
        let response = await FetchApi.delete(url);
        return response;
    }

    /**
     * 担当者情報を削除
     * 
     * @param {array} ids 担当者情報ID
     * @returns {object}  
     */
    static async deletes(ids) {
        let response = await FetchApi.delete(UserApi.PREFIX, {ids : ids});
        return response;
    }
}