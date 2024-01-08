/**
 * ConfirmModal
 * 
 */
class ConfirmModal {
    /**
     * オーバーレイ
     * 
     */
    $overlay;
    /**
     * ボタンクリック時のコールバック先クラス
     * 
     */
    callbackClass;
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
     * Yesボタン
     * 
     */
    $btnYes;
    /**
     * Noボタン
     * 
     */
    $btnNo;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
    /**
     * エラーメッセージ
     * 
     */
    errorMessage;
    /**
     * context
     * 
     */
    context;

    /**
     * constructor
     * 
     * @param {class}  callbackClass ボタンクリック時のコールバック先クラス
     * @param {string} id            モーダルID
     */
    constructor(callbackClass = null, id = 'modalConfirm') {
        this.callbackClass = callbackClass;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + id + 'BtnClose');
        this.$btnYes = $('#' + id + 'BtnYes');
        this.$btnNo = $('#' + id + 'BtnNo');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // オーバーレイを設定
        this.$overlay = this.$modal.closest('.overlay');

        // イベントを設定
        this.$overlay.on('click', { me : this }, this.close);
        this.$modal.on('click', this.clickModal);
        this.$btnClose.on('click', { me : this }, this.close);
        this.$btnYes.on('click', { me : this }, this.clickBtnYes);
        this.$btnNo.on('click', { me : this }, this.clickBtnNo);
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
        me.errorMessage.hide();
        me.$overlay.hide();
        me.$modal.hide();
    }

    /**
     * モーダルクリック時
     * 
     * @param {Event} e 
     */
    clickModal(e) { e.stopPropagation(); }

    /**
     * Yesボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnYes(e) {
        let me = e.data.me;
        me.callbackClass.yesCallback(e);
    }

    /**
     * Noボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnNo(e) {
        let me = e.data.me;
        me.callbackClass.noCallback(e);
    }

    /**
     * contextに値を設定
     * 
     * @param {object} context 
     */
    setContext(context) {
        this.context = context;
    }
}