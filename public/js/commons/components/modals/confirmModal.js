/**
 * ConfirmModalCallbackClass
 * 
 */
class ConfirmModalCallbackClass {
    /**
     * constructor
     * 
     * @param {Function} yesCallbackProc Yesボタンクリック時コールバック
     * @param {Function} noCallbackProc  Noボタンクリック時コールバック
     * @param {object}   context              context
     */
    constructor(yesCallbackProc = null, noCallbackProc = null, context = null) {
        this.yesCallbackProc = yesCallbackProc;
        this.noCallbackProc = noCallbackProc;
        this.context = context;
    };

    /**
     * Yesボタンクリック時コールバック
     * 
     * @param {Event} e
     */
    yesCallback(e) {
        this.modal = e.data.me;
        if (this.yesCallbackProc != null) {
            this.yesCallbackProc(e);
        } else {
            this.modal.close(e);
        }
    }

    /**
     * Yesボタンクリック時コールバック
     * 
     * @param {Event} e
     */
    noCallback(e) {
        this.modal = e.data.me;
        if (this.noCallbackProc != null) {
            this.noCallbackProc(e);
        } else {
            this.modal.close(e);
        }
    }
}

/**
 * ConfirmModal
 * 
 */
class ConfirmModal extends Modal {
    /**
     * ボタンクリック時のコールバック先クラス
     * 
     */
    callbackClass;
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
     * constructor
     * 
     * @param {class}  callbackClass ボタンクリック時のコールバック先クラス
     * @param {string} id            モーダルID
     */
    constructor(callbackClass = null, id = 'modalConfirm') {
        super(id);
        this.callbackClass = callbackClass;
        this.$btnYes = $('#' + id + 'BtnYes');
        this.$btnNo = $('#' + id + 'BtnNo');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // イベントを設定
        this.$btnYes.on('click', { me : this }, this.clickBtnYes);
        this.$btnNo.on('click', { me : this }, this.clickBtnNo);
    }

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
}