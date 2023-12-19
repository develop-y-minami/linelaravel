/**
 * LineProfileContainer
 * 
 */
class LineProfileContainer {
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
     * constructor
     * 
     * @param {string} id コンテナーID
     */
    constructor(id = 'lineProfileContainer') {
        this.$container = $('#' + id);
        this.$imgPictureUrl = $('#' + id + 'ImgPictureUrl');
        this.$tdDisplayName = $('#' + id + 'TdDisplayName');
        this.$tdLineAccountTypeName = $('#' + id + 'TdLineAccountTypeName');
    }
}