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
     * line/serviceProvider
     * 
     */
    static PREFIX_SERVICE_PROVIDER = LineApi.PREFIX + '/serviceProvider';
    /**
     * line/{id}/user/setting
     * 
     */
    static PREFIX_LINE_USER_SETTING = '/user/setting';
    /**
     * line/{id}/talk/historys
     * 
     */
    static PREFIX_LINE_TALK_HISTORYS = '/talk/historys';

    /**
     * LINE情報を取得する
     * 
     * @param {number} lineAccountTypeId      LINEアカウント種別情報ID
     * @param {number} lineAccountStatusId    LINEアカウント状態情報ID
     * @param {string} lineChannelDisplayName LINEプロフィール表示名
     * @param {number} serviceProviderId      サービス提供者情報ID
     * @param {number} userId                 担当者情報ID
     * @returns {object} 
     */
    static async lines({lineAccountTypeId = null, lineAccountStatusId = null, lineChannelDisplayName = null, serviceProviderId = null, userId = null}) {
        // パラメータを設定
        let data = {};
        if (lineAccountTypeId !== null) data.lineAccountTypeId = lineAccountTypeId;
        if (lineAccountStatusId !== null) data.lineAccountStatusId = lineAccountStatusId;
        if (lineChannelDisplayName !== null) data.lineChannelDisplayName = lineChannelDisplayName;
        if (serviceProviderId !== null) data.serviceProviderId = serviceProviderId;
        if (userId !== null) data.userId = userId;

        let response = await FetchApi.post(LineApi.PREFIX, data);
        return response;
    }

    /**
     * LINE通知情報を取得する
     * 
     * @param {string} noticeDate             通知日
     * @param {number} lineNoticeTypeId       LINE通知種別情報ID
     * @param {string} lineChannelDisplayName LINEプロフィール表示名
     * @param {number} serviceProviderId      サービス提供者情報ID
     * @param {number} userId                 担当者情報ID
     * @returns {object} 
     */
    static async notices({noticeDate = null, lineNoticeTypeId = null, lineChannelDisplayName = null, serviceProviderId = null, userId = null}) {
        // パラメータを設定
        let data = {};
        if (noticeDate !== null) data.noticeDate = noticeDate;
        if (lineNoticeTypeId !== null) data.lineNoticeTypeId = lineNoticeTypeId;
        if (lineChannelDisplayName !== null) data.lineChannelDisplayName = lineChannelDisplayName;
        if (serviceProviderId !== null) data.serviceProviderId = serviceProviderId;
        if (userId !== null) data.userId = userId;

        let response = await FetchApi.post(LineApi.PREFIX_NOTICES, data);
        return response;
    }

    /**
     * サービス提供者を設定
     * 
     * @param {array}  ids               ID
     * @param {number} serviceProviderId サービス提供者情報ID
     * @returns {object} 
     */
    static async updatesServiceProvider(ids, serviceProviderId) {
        // パラメータを設定
        let data = {};
        data.ids = ids;
        data.serviceProviderId = serviceProviderId;

        let response = await FetchApi.patch(LineApi.PREFIX_SERVICE_PROVIDER, data);
        return response;
    }

    /**
     * LINE担当者情報を設定する
     * 
     * @param {number}  id                ID
     * @param {number}  userId            担当者情報ID
     * @param {boolean} noticeSetting     LINE通知設定
     * @param {array}   lineNoticeSttings LINE通知種別
     * @returns {object} 
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

    /**
     * LINEトーク履歴を取得する
     * 
     * @param {number}  id                  ID
     * @param {number}  lineTalkHistoryTerm LINEトーク履歴表示期間
     * @returns {object} 
     */
    static async lineTalkHistorys(id, lineTalkHistoryTerm = null) {
        // URLを設定
        let url = LineApi.PREFIX + '/' + id + LineApi.PREFIX_LINE_TALK_HISTORYS;

        // パラメータを設定
        let data = {};
        data.id = id;
        if (lineTalkHistoryTerm !== null) data.lineTalkHistoryTerm = lineTalkHistoryTerm;

        let response = await FetchApi.post(url, data);
        return response;
    }
}