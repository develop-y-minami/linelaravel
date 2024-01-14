/**
 * serviceProviderSettingModal
 * 
 */
class ServiceProviderSettingModal {
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
     * 設定ボタン
     * 
     */
    $btnSetting;
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
    constructor(callbackClass = null, id = 'modalServiceProviderSetting') {
        this.callbackClass = callbackClass;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + id + 'BtnClose');

        this.$btnSetting = $('#' + id + 'BtnSetting');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // オーバーレイを設定
        this.$overlay = this.$modal.closest('.overlay');

        // イベントを設定
        this.$overlay.on('click', { me : this }, this.close);
        this.$modal.on('click', this.clickModal);
        this.$btnClose.on('click', { me : this }, this.close);
        this.$btnSetting.on('click', { me : this }, this.clickBtnSetting);
    }

    /**
     * モーダルを初期化
     * 
     */
    init() {
        
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
}