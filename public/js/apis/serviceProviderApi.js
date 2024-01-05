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
     * serviceProvider/register
     * 
     */
    static PREFIX_REGISTER = ServiceProviderApi.PREFIX + '/register';

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
    static async  serviceProviders(
        providerId = null,
        name = null,
        useStartDateTime = null,
        useEndDateTime = null,
        useStop = null
    ) {
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

        let response = await FetchApi.post(ServiceProviderApi.PREFIX_REGISTER, data);
        return response;
    }
}