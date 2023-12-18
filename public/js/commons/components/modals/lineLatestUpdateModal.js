/**
 * LineLatestUpdateModal
 * 
 */
class LineLatestUpdateModal {
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
     * モーダル
     * 
     */
    $modal;
    /**
     * 閉じるボタン
     * 
     */
    $btnClose;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
    /**
     * エラーメッセージ
     * 
     */
    $errorMessage;
    /**
     * 最新情報で更新ボタン
     * 
     */
    $btnLineLatestUpdate;
    /**
     * LINEプロフィールコンテナー
     * 
     */
    lineProfileContainer;
    /**
     * エラーメッセージ
     * 
     */
    errorMessage;

    /**
     * constructor
     * 
     * @param {number}   lineId                  LINE情報ID
     * @param {object}   $overlay                オーバーレイ
     * @param {string}   id                      モーダルID
     * @param {string}   btnCloseId              閉じるボタンID 
     * @param {string}   loadingOverlayId        ローディングオーバーレイID
     * @param {string}   errorMessageId          エラーメッセージID
     * @param {string}   btnLineLatestUpdateId   最新情報で更新ボタンID
     * @param {string}   lineProfileContainerId  LINEプロフィールコンテナー：ID
     * @param {string}   imgPictureUrlId         LINEプロフィールコンテナー：LINEプロフィール画像ID
     * @param {string}   tdDisplayNameId         LINEプロフィールコンテナー：LINE表示名ID
     * @param {string}   tdLineAccountTypeNameId LINEプロフィールコンテナー：LINEアカウント種別ID
     */
    constructor(
        lineId,
        $overlay,
        id = 'modalLineLatestUpdate',
        btnCloseId = 'btnCloseModalLineLatestUpdate',
        loadingOverlayId = 'loadingOverlayModalLineLatestUpdate',
        errorMessageId = 'errorMessageModalLineLatestUpdate',
        btnLineLatestUpdateId = 'btnModalLineLatestUpdate',
        lineProfileContainerId = 'lineProfileContainerModalLineLatestUpdate',
        imgPictureUrlId = 'imgPictureUrlModalLineLatestUpdate',
        tdDisplayNameId = 'tdDisplayNameModalLineLatestUpdate',
        tdLineAccountTypeNameId = 'tdLineAccountTypeNameModalLineLatestUpdate'
    ) {
        this.$lineId = lineId;
        this.$overlay = $overlay;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + btnCloseId);
        this.$loadingOverlay = $('#' + loadingOverlayId);
        this.$errorMessage = $('#' + errorMessageId);
        this.$btnLineLatestUpdate = $('#' + btnLineLatestUpdateId);

        // LINEプロフィールコンテナーインスタンスを生成
        this.lineProfileContainer = new LineProfileContainer(
            lineProfileContainerId,
            imgPictureUrlId,
            tdDisplayNameId,
            tdLineAccountTypeNameId
        );

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(this.$errorMessage);

        // イベントを設定
        this.$overlay.on('click', { me : this }, this.close);
        this.$modal.on('click', this.clickModal);
        this.$btnClose.on('click', { me : this }, this.close);
    }

    /**
     * モーダルを表示
     * 
     */
    show() {
        this.$overlay.show();
        this.$modal.fadeIn();
    }

    /**
     * モーダルを閉じる
     * 
     * @param {Event} e 
     */
    close(e) {
        let me = e.data.me;
        me.$overlay.hide();
        me.$modal.hide();
    }

    /**
     * モーダルクリック時
     * 
     * @param {Event} e 
     */
    clickModal(e) { e.stopPropagation(); }
}