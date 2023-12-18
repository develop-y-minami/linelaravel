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

    constructor(
        id = 'lineProfileContainer',
        imgPictureUrlId = 'imgPictureUrl',
        tdDisplayNameId = 'tdDisplayName',
        tdLineAccountTypeNameId = 'tdLineAccountTypeName'
    ) {
        this.$container = $('#' + id);
        this.$imgPictureUrl = $('#' + imgPictureUrlId);
        this.$tdDisplayName = $('#' + tdDisplayNameId);
        this.$tdLineAccountTypeName = $('#' + tdLineAccountTypeNameId);
    }
}