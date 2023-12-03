/**
 * LineApi
 * 
 */
class LineApi {

    /**
     * プレフィックス
     * 
     */
    static PREFIX = 'line';

    /**
     * line/bot
     * 
     */
    static PREFIX_BOT = LineApi.PREFIX + '/bot';

    /**
     * ボットの情報を取得する
     * 
     * @returns {object} 
     */
    static async getBotInfo() {
        let response = await FetchApi.get(LineApi.PREFIX_BOT + '/info');
        return response;
    }

}