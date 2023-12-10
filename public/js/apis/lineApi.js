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
    static PREFIX_NOTICE = LineApi.PREFIX + '/notice';

    /**
     * LINE通知情報を取得する
     * 
     * @param {string} noticeDate       通知日
     * @param {number} lineNoticeTypeId LINE通知種別
     * @param {string} displayName      LINE表示名
     * @param {number} userId           担当者ID
     * @returns {object} 
     */
    static async getNotices(noticeDate = null, lineNoticeTypeId = null, displayName = null, userId = null) {
        // パラメータを設定
        let data = {};
        if (noticeDate !== null) data.noticeDate = noticeDate;
        if (lineNoticeTypeId !== null) data.lineNoticeTypeId = lineNoticeTypeId;
        if (displayName !== null) data.displayName = displayName;
        if (userId !== null) data.userId = userId;

        let response = await FetchApi.post(LineApi.PREFIX_NOTICE, data);
        return response;
    }

}