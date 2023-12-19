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
     * 最新情報で更新ボタン
     * 
     */
    $btnUpdate;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
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
     * @param {number}   lineId   LINE情報ID
     * @param {object}   $overlay オーバーレイ
     * @param {string}   id       モーダルID
     */
    constructor(lineId, $overlay, id = 'modalLineLatestUpdate') {
        this.$lineId = lineId;
        this.$overlay = $overlay;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + id + 'BtnClose');
        this.$btnUpdate = $('#' + id + 'btnUpdate');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // LINEプロフィールコンテナーインスタンスを生成
        this.lineProfileContainer = new LineProfileContainer(lineId, id);

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

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