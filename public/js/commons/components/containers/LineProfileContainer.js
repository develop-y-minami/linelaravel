/**
 * LineProfileContainer
 * 
 */
class LineProfileContainer {
    /**
     * LINE情報ID
     * 
     */
    lineId;
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * LINEプロフィール画像
     * 
     */
    $imgPictureUrl;
    /**
     * LINE表示名
     * 
     */
    $tdDisplayName;
    /**
     * LINEアカウント種別
     * 
     */
    $tdLineAccountTypeName;

    /**
     * 
     * @param {string} lineId LINE情報ID
     * @param {string} id     コンテナーID
     */
    constructor(lineId, id = 'lineProfileContainer') {
        this.lineId = lineId;
        this.$container = $('#' + id);
        this.$imgPictureUrl = $('#' + id + 'ImgPictureUrl');
        this.$tdDisplayName = $('#' + id + 'TdDisplayName');
        this.$tdLineAccountTypeName = $('#' + id + 'TdLineAccountTypeName');
    }
}