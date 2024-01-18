/**
 * ServiceProviderApi
 * 
 */
class ServiceProviderApi {
    /**
     * プレフィックス
     * 
     */
    static PREFIX = 'serviceProvider';

    /**
     * サービス提供者情報を取得
     * 
     * @param {string}  providerId       サービス利用者ID
     * @param {string}  name             サービス利用者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @param {boolean} useStop          サービス利用状態
     * @returns {object}  
     */
    static async  serviceProviders({providerId = null, name = null, useStartDateTime = null, useEndDateTime = null, useStop = null}) {
        // パラメータを設定
        let data = {};
        if (providerId !== null) data.providerId = providerId;
        if (name !== null) data.name = name;
        if (useStartDateTime !== null) data.useStartDateTime = useStartDateTime;
        if (useEndDateTime !== null) data.useEndDateTime = useEndDateTime;
        if (useStop !== null) data.useStop = useStop;

        let response = await FetchApi.post(ServiceProviderApi.PREFIX, data);
        return response;
    }

    /**
     * サービス提供者情報を登録
     * 
     * @param {string}  providerId       サービス提供者ID
     * @param {string}  name             サービス提供者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @returns {object}  
     */
    static async register(providerId, name, useStartDateTime, useEndDateTime) {
        // パラメータを設定
        let data = {};
        data.providerId = providerId;
        data.name = name;
        data.useStartDateTime = useStartDateTime;
        data.useEndDateTime = useEndDateTime;

        let response = await FetchApi.put(ServiceProviderApi.PREFIX, data);
        return response;
    }

    /**
     * サービス提供者情報を更新
     * 
     * @param {number}  id               サービス提供者情報ID 
     * @param {string}  providerId       サービス提供者ID
     * @param {string}  name             サービス提供者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @param {boolean} useStop          サービス利用状態
     * @returns {object}  
     */
    static async update(id, providerId, name, useStartDateTime, useEndDateTime, useStop) {
        let url = ServiceProviderApi.PREFIX + '/' + id;

        // パラメータを設定
        let data = {};
        data.id = id;
        data.providerId = providerId;
        data.name = name;
        data.useStartDateTime = useStartDateTime;
        data.useEndDateTime = useEndDateTime;
        data.useStop = useStop;

        let response = await FetchApi.patch(url, data);
        return response;
    }

    /**
     * サービス提供者情報を削除
     * 
     * @param {number} id サービス提供者情報ID
     * @returns {object}  
     */
    static async destroy(id) {
        let url = ServiceProviderApi.PREFIX + '/' + id;
        let response = await FetchApi.delete(url);
        return response;
    }
}