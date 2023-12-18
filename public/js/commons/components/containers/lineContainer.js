/**
 * LineContainer
 * 
 */
class LineContainer {
    /**
     * LINE情報ID
     * 
     */
    lineId;
    /**
     * オーバーレイ
     * 
     */
    $overlay;
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * LINEから最新情報を取得するボタン
     * 
     */
    $btnLineLatestUpdate;
    /**
     * LINEアカウント状態ラベルボックス
     * 
     */
    $lineAccountStatusLabelBox;
    /**
     * LINEプロフィールコンテナー
     * 
     */
    lineProfileContainer;
    /**
     * LINE最新情報更新モーダル
     * 
     */
    lineLatestUpdateModal;

    /**
     * 
     * @param {number} lineId                                       LINE情報ID
     * @param {object} $overlay                                     オーバーレイ
     * @param {string} id                                           モーダルID
     * @param {string} btnLineLatestUpdateId                        LINEから最新情報を取得するボタンID
     * @param {string} lineAccountStatusLabelBoxId                  LINEアカウント状態ラベルボックスID
     * @param {string} lineProfileContainerId                       LINEプロフィールコンテナー：ID
     * @param {string} imgPictureUrlId                              LINEプロフィールコンテナー：LINEプロフィール画像ID
     * @param {string} tdDisplayNameId                              LINEプロフィールコンテナー：LINE表示名ID
     * @param {string} tdLineAccountTypeNameId                      LINEプロフィールコンテナー：LINEアカウント種別ID
     * @param {string} modalLineLatestUpdateId                      LINE最新情報更新モーダルID
     * @param {string} modalLineLatestUpdateBtnCloseId              LINE最新情報更新モーダル：閉じるボタンID
     * @param {string} modalLineLatestUpdateLoadingOverlayId        LINE最新情報更新モーダル：ローディングオーバーレイID
     * @param {string} modalLineLatestUpdateErrorMessageId          LINE最新情報更新モーダル：エラーメッセージID
     * @param {string} modalLineLatestUpdateBtnLineLatestUpdateId   LINE最新情報更新モーダル：最新情報で更新ボタンID
     * @param {string} modalLineLatestUpdateLineProfileContainerId  LINE最新情報更新モーダル：LINEプロフィールコンテナー：ID
     * @param {string} modalLineLatestUpdateImgPictureUrlId         LINE最新情報更新モーダル：LINEプロフィールコンテナー：LINEプロフィール画像ID
     * @param {string} modalLineLatestUpdateTdDisplayNameId         LINE最新情報更新モーダル：LINEプロフィールコンテナー：LINE表示名ID
     * @param {string} modalLineLatestUpdateTdLineAccountTypeNameId LINE最新情報更新モーダル：LINEプロフィールコンテナー：LINEアカウント種別ID
     */
    constructor(
        lineId,
        $overlay,
        id = 'lineContainer',
        btnLineLatestUpdateId = 'btnLineLatestUpdate',
        lineAccountStatusLabelBoxId = 'lineAccountStatusLabelBox',
        lineProfileContainerId = 'lineProfileContainerLineContainer',
        imgPictureUrlId = 'imgPictureUrlLineContainer',
        tdDisplayNameId = 'tdDisplayNameLineContainer',
        tdLineAccountTypeNameId = 'tdLineAccountTypeNameLineContainer',
        modalLineLatestUpdateId = 'modalLineLatestUpdate',
        modalLineLatestUpdateBtnCloseId = 'btnCloseModalLineLatestUpdate',
        modalLineLatestUpdateLoadingOverlayId = 'loadingOverlayModalLineLatestUpdate',
        modalLineLatestUpdateErrorMessageId = 'errorMessageModalLineLatestUpdate',
        modalLineLatestUpdateBtnLineLatestUpdateId = 'btnModalLineLatestUpdate',
        modalLineLatestUpdateLineProfileContainerId = 'updateProfileContainerModalLineLatestUpdate',
        modalLineLatestUpdateImgPictureUrlId = 'imgPictureUrlModalLineLatestUpdate',
        modalLineLatestUpdateTdDisplayNameId = 'tdDisplayNameModalLineLatestUpdate',
        modalLineLatestUpdateTdLineAccountTypeNameId = 'tdLineAccountTypeNameModalLineLatestUpdate'
    ) {
        this.lineId = lineId;
        this.$overlay = $overlay;
        this.$container = $('#' + id);
        this.$btnLineLatestUpdate = $('#' + btnLineLatestUpdateId);
        this.$lineAccountStatusLabelBox = $('#' + lineAccountStatusLabelBoxId);

        // LINEプロフィールコンテナーインスタンスを生成
        this.lineProfileContainer = new LineProfileContainer(
            lineProfileContainerId,
            imgPictureUrlId,
            tdDisplayNameId,
            tdLineAccountTypeNameId
        );

        // LINE最新情報更新モーダルインスタンスを生成
        this.lineLatestUpdateModal = new LineLatestUpdateModal(
            lineId,
            $overlay,
            modalLineLatestUpdateId,
            modalLineLatestUpdateBtnCloseId,
            modalLineLatestUpdateLoadingOverlayId,
            modalLineLatestUpdateErrorMessageId,
            modalLineLatestUpdateBtnLineLatestUpdateId,
            modalLineLatestUpdateLineProfileContainerId,
            modalLineLatestUpdateImgPictureUrlId,
            modalLineLatestUpdateTdDisplayNameId,
            modalLineLatestUpdateTdLineAccountTypeNameId
        );

        // イベントを設定
        this.$btnLineLatestUpdate.on('click', { me : this }, this.clickBtnLineLatestUpdate)
    }

    /**
     * LINEから最新情報を取得するボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnLineLatestUpdate(e) {
        let me = e.data.me;
        // LINE最新情報更新モーダルを起動
        me.lineLatestUpdateModal.show();
    }
}