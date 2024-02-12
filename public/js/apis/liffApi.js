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
    PREFIX = 'liff';
    /**
     * プレフィックス（verify）
     * 
     */
    PREFIX_VERIFY = this.PREFIX + '/verify';
    /**
     * プレフィックス（line）
     * 
     */
    PREFIX_LINE = this.PREFIX + '/line';
    /**
     * プレフィックス（serviceProvider）
     * 
     */
    PREFIX_SERVICE_PROVIDER = '/serviceProvider';
    /**
     * プレフィックス（verify/accessToken）
     * 
     */
    PREFIX_VERIFY_ACCESS_TOKEN = this.PREFIX_VERIFY + '/accessToken';
    /**
     * プレフィックス（verify/serviceProvider）
     * 
     */
    PREFIX_VERIFY_SERVICE_PROVIDER = this.PREFIX_VERIFY + '/serviceProvider';
    /**
     * アクセストークン
     * 
     */
    accessToken;

    /**
     * constructor
     * 
     * @param {string} accessToken アクセストークン
     */
    constructor(accessToken) {
        this.accessToken = accessToken;
    }

    /**
     * アクセストークンの検証を実施
     * 
     * @returns {object}  
     */
    async verifyAccessToken() {
        let response = await this.post(this.PREFIX_VERIFY_ACCESS_TOKEN);
        return response;
    }

    /**
     * サービス提供者情報.提供者IDを確認
     * 
     * @param {string} providerId 提供者ID
     * @returns {object}  
     */
    async verifyServiceProvider(providerId) {
        // パラメータを設定
        let data = {};
        data.providerId = providerId;

        let response = await this.post(this.PREFIX_VERIFY_SERVICE_PROVIDER, data);
        return response;
    }

    /**
     * サービス提供者情報を更新
     * 
     * @param {number} id                LINE情報ID
     * @param {number} serviceProviderId サービス提供者情報ID
     * @returns {object}  
     */
    async updateServiceProvider(id, serviceProviderId) {
        // URLを設定
        let url = this.PREFIX_LINE + '/' + id + this.PREFIX_SERVICE_PROVIDER;

        // パラメータを設定
        let data = {};
        data.serviceProviderId = serviceProviderId;

        let response = await this.patch(url, data);
        return response;
    }

    /**
     * POST
     * 
     * @param {string} url  URL
     * @param {object} data データ
     */
    async post(url, data = {}) {
        let headers = {'Authorization' : 'Bearer ' + this.accessToken};
        let response = await FetchApi.post(url, data, headers);
        return response;
    }

    /**
     * PATCH
     * 
     * @param {string} url  URL
     * @param {object} data データ
     */
    async patch(url, data = {}) {
        let headers = {'Authorization' : 'Bearer ' + this.accessToken};
        let response = await FetchApi.patch(url, data, headers);
        return response;
    }
}