/**
 * LiffApi
 * 
 * Liff Api
 * 
 */
class LiffApi {
    /**
     * プレフィックス
     * 
     */
    static PREFIX = 'liff';
    /**
     * プレフィックス（verify）
     * 
     */
    static PREFIX_VERIFY = LiffApi.PREFIX + '/verify';
    /**
     * プレフィックス（verify/serviceProvider）
     * 
     */
    static PREFIX_VERIFY_SERVICE_PROVIDER = LiffApi.PREFIX_VERIFY + '/serviceProvider';

    /**
     * サービス提供者情報.提供者IDを確認
     * 
     * @param {string} providerId 提供者ID
     * @returns {object}  
     */
    static async verifyServiceProvider(providerId) {
        // パラメータを設定
        let data = {};
        data.providerId = providerId;

        let response = await FetchApi.post(LiffApi.PREFIX_VERIFY_SERVICE_PROVIDER, data);
        return response;
    }
}