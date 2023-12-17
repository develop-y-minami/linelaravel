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
     * line/{id}/user/setting
     * 
     */
    static PREFIX_LINE_USER_SETTING = '/user/setting';

    /**
     * LINE通知情報を取得する
     * 
     * @param {string} noticeDate       通知日
     * @param {number} lineNoticeTypeId LINE通知種別
     * @param {string} displayName      LINE表示名
     * @param {number} userId           担当者ID
     * @returns {object} 
     */
    static async notices(noticeDate = null, lineNoticeTypeId = null, displayName = null, userId = null) {
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
    static async lines(lineAccountTypeId = null, lineAccountStatusId = null, displayName = null, userId = null) {
        // パラメータを設定
        let data = {};
        if (lineAccountTypeId !== null) data.lineAccountTypeId = lineAccountTypeId;
        if (lineAccountStatusId !== null) data.lineAccountStatusId = lineAccountStatusId;
        if (displayName !== null) data.displayName = displayName;
        if (userId !== null) data.userId = userId;

        let response = await FetchApi.post(LineApi.PREFIX_LINES, data);
        return response;
    }

    /**
     * LINE担当者情報を設定する
     * 
     * @param {number}  id                LINE情報ID
     * @param {number}  userId            担当者ID
     * @param {boolean} noticeSetting     LINE通知設定
     * @param {array}   lineNoticeSttings LINE通知種別
     * @returns 
     */
    static async userSetting(id, userId, noticeSetting, lineNoticeSttings) {
        // URLを設定
        let url = LineApi.PREFIX + '/' + id + LineApi.PREFIX_LINE_USER_SETTING;

        // パラメータを設定
        let data = {};
        data.userId = userId;
        data.noticeSetting = noticeSetting;
        data.lineNoticeSttings = lineNoticeSttings;

        let response = await FetchApi.post(url, data);
        return response;
    }
}