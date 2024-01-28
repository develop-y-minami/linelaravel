/**
 * LineMessagingApi
 * 
 * Messaging Api
 * 
 */
class LineMessagingApi {

    /**
     * プレフィックス
     * 
     */
    static PREFIX = 'line/messaging/api';

    /**
     * line/bot
     * 
     */
    static PREFIX_BOT = LineMessagingApi.PREFIX + '/bot';

    /**
     * ボットの情報を取得する
     * 
     * @returns {object} 
     */
    static async botInfo() {
        let response = await FetchApi.get(LineMessagingApi.PREFIX_BOT + '/info');
        return response;
    }

}