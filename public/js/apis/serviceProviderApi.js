/**
 * ServiceProviderApi
 * 
 * サービス提供者情報
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
     * @param {string}  providerId   提供者ID
     * @param {string}  name         提供者名
     * @param {string}  useStartDate 利用開始日
     * @param {string}  useEndDate   利用終了日
     * @param {boolean} useStopFlg   利用停止フラグ
     * @returns {object}  
     */
    static async  serviceProviders({providerId = null, name = null, useStartDate = null, useEndDate = null, useStopFlg = null}) {
        // パラメータを設定
        let data = {};
        if (providerId !== null) data.providerId = providerId;
        if (name !== null) data.name = name;
        if (useStartDate !== null) data.useStartDate = useStartDate;
        if (useEndDate !== null) data.useEndDate = useEndDate;
        if (useStopFlg !== null) data.useStopFlg = useStopFlg;

        let response = await FetchApi.post(ServiceProviderApi.PREFIX, data);
        return response;
    }

    /**
     * サービス提供者情報を登録
     * 
     * @param {string} providerId   提供者ID
     * @param {string} name         提供者名
     * @param {string} useStartDate 利用開始日
     * @param {string} useEndDate   利用終了日
     * @returns {object}  
     */
    static async register(providerId, name, useStartDate, useEndDate) {
        // パラメータを設定
        let data = {};
        data.providerId = providerId;
        data.name = name;
        data.useStartDate = useStartDate;
        data.useEndDate = useEndDate;

        let response = await FetchApi.put(ServiceProviderApi.PREFIX, data);
        return response;
    }

    /**
     * サービス提供者情報を更新
     * 
     * @param {number}  id           ID 
     * @param {string}  providerId   提供者ID
     * @param {string}  name         提供者名
     * @param {string}  useStartDate 利用開始日
     * @param {string}  useEndDate   利用終了日
     * @param {boolean} useStopFlg   利用停止フラグ
     * @returns {object}  
     */
    static async update(id, providerId, name, useStartDate, useEndDate, useStopFlg) {
        let url = ServiceProviderApi.PREFIX + '/' + id;

        // パラメータを設定
        let data = {};
        data.id = id;
        data.providerId = providerId;
        data.name = name;
        data.useStartDate = useStartDate;
        data.useEndDate = useEndDate;
        data.useStopFlg = useStopFlg;

        let response = await FetchApi.patch(url, data);
        return response;
    }

    /**
     * サービス提供者情報を削除
     * 
     * @param {number} id ID
     * @returns {object}  
     */
    static async destroy(id) {
        let url = ServiceProviderApi.PREFIX + '/' + id;
        let response = await FetchApi.delete(url);
        return response;
    }
}