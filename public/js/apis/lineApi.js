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
     * line/notices
     * 
     */
    static PREFIX_NOTICES = LineApi.PREFIX + '/notices';
    /**
     * line/lines
     * 
     */
    static PREFIX_LINES = LineApi.PREFIX + '/lines';

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

        let response = await FetchApi.post(LineApi.PREFIX_NOTICES, data);
        return response;
    }

    /**
     * LINE情報を取得する
     * 
     * @param {number} lineAccountTypeId   LINEアカウント種別ID
     * @param {number} lineAccountStatusId LINEアカウント状態
     * @param {string} displayName         LINE表示名
     * @param {number} userId              担当者ID
     * @returns {object} 
     */
    static async getLines(lineAccountTypeId = null, lineAccountStatusId = null, displayName = null, userId = null) {
        // パラメータを設定
        let data = {};
        if (lineAccountTypeId !== null) data.lineAccountTypeId = lineAccountTypeId;
        if (lineAccountStatusId !== null) data.lineAccountStatusId = lineAccountStatusId;
        if (displayName !== null) data.displayName = displayName;
        if (userId !== null) data.userId = userId;

        let response = await FetchApi.post(LineApi.PREFIX_LINES, data);
        return response;
    }
}