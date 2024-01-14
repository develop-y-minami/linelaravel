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
     * サービス提供者ID
     * 
     */
    $txtServiceProviderId;
    /**
     * サービス提供者
     * 
     */
    $selServiceProvider;
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
     * サービス提供者ID
     * 
     */
    initServiceProviderId;

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
        this.$txtServiceProviderId = $('#' + id + 'TxtServiceProviderId');
        this.$selServiceProvider = $('#' + id + 'SelServiceProvider');
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

        // 初期値を選択値に保持
        this.initServiceProviderId = this.$selServiceProvider.val();
    }

    /**
     * モーダルを初期化
     * 
     */
    init() {
        this.$selServiceProvider.val(this.initServiceProviderId);
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