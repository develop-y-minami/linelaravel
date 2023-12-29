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
     * サービス提供者場を登録
     * 
     * @param {string}  providerId       提供者ID
     * @param {string}  name             提供者名
     * @param {string}  useStartDateTime 利用開始日
     * @param {string}  useEndDateTime   利用終了日
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