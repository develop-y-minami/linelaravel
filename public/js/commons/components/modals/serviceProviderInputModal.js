/**
 * ServiceProviderInputModal
 * 
 */
class ServiceProviderInputModal {
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
     * 提供者ID
     * 
     */
    $txtProviderId;
    /**
     * 提供者名
     * 
     */
    $txtName;
    /**
     * 利用開始日
     * 
     */
    $txtUseStartDateTime;
    /**
     * 利用終了日
     * 
     */
    $txtUseEndDateTime;
    /**
     * 使用状態コンテナー
     * 
     */
    $checkUseStopContainer;
    /**
     * 使用状態
     * 
     */
    $checkUseStop;
    /**
     * 登録ボタン
     * 
     */
    $btnRegister;
    /**
     * 更新ボタン
     * 
     */
    $btnUpdate;
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
    errorMessage;

    /**
     * constructor
     * 
     * @param {class}  callbackClass ボタンクリック時のコールバック先クラス
     * @param {string} id            モーダルID
     */
    constructor(callbackClass = null, id = 'modalServiceProviderInput') {
        this.callbackClass = callbackClass;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + id + 'BtnClose');
        this.$txtProviderId = $('#' + id + 'TxtProviderId');
        this.$txtName = $('#' + id + 'TxtName');
        this.$txtUseStartDateTime = $('#' + id + 'TxtUseStartDateTime');
        this.$txtUseEndDateTime = $('#' + id + 'TxtUseEndDateTime');
        this.$checkUseStopContainer = $('#' + id + 'CheckUseStopContainer');
        this.$checkUseStop = $('#' + id + 'CheckUseStop');
        this.$btnRegister = $('#' + id + 'BtnRegister');
        this.$btnUpdate = $('#' + id + 'BtnUpdate');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // オーバーレイを設定
        this.$overlay = this.$modal.closest('.overlay');

        // イベントを設定
        this.$overlay.on('click', { me : this }, this.close);
        this.$modal.on('click', this.clickModal);
        this.$btnClose.on('click', { me : this }, this.close);
        this.$btnRegister.on('click', { me : this }, this.clickBtnRegister);
    }

    /**
     * モーダルを初期化
     * 
     */
    init() {
        this.$txtProviderId.val('');
        this.$txtName.val('');
        this.$txtUseStartDateTime.val(DateTimeUtil.getToday());
        this.$txtUseEndDateTime.val('');
        this.$checkUseStop.prop('checked', false);
    }

    /**
     * モーダルを表示
     * 
     * @param int mode 表示モード
     */
    show(mode) {
        // モーダルを初期化
        this.init();

        // 表示モードを変更
        if (mode === EditMode.REGISTER) {
            this.showRegister();
        } else if (mode === EditMode.UPDATE) {
            this.showUpdate();
        }

        this.$overlay.show();
        this.$modal.fadeIn();
    }

    /**
     * 登録モードを表示
     * 
     */
    showRegister() {
        this.$checkUseStopContainer.hide();
        this.$btnUpdate.hide();
        this.$btnRegister.show();
    }

    /**
     * 更新モードを表示
     * 
     */
    showUpdate() {
        this.$checkUseStopContainer.show();
        this.$btnUpdate.show();
        this.$btnRegister.hide();
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
     * 登録ボタンクリック時
     * 
     * @param {Event} e 
     */
    async clickBtnRegister(e) {
        let me = e.data.me;

        try {
            // エラーメッセージを非表示
            me.errorMessage.hide();

            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

            // パラメータを取得
            let providerId = me.$txtProviderId.val().trim();
            let name = me.$txtName.val().trim();
            let useStartDateTime = me.$txtUseStartDateTime.val();
            let useEndDateTime = me.$txtUseEndDateTime.val();

            // サービス提供者情報を登録
            let result = await ServiceProviderApi.register(providerId, name, useStartDateTime, useEndDateTime);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                if (me.callbackClass !== null) {
                    // コールバックを実行
                    me.callbackClass.serviceProviderRegisterCallback();
                }
            } else {
                if (result.code === FetchApi.STATUS_CODE_VALIDATION_EXCEPTION) {
                    // バリデーションエラー時のメッセージを表示
                    let erros = [];
                    for (let i = 0; i < result.errors.length; i++) {
                        erros.push(result.errors[i].message);
                    }
                    me.errorMessage.showMessages(erros);
                } else {
                    me.errorMessage.showServerError();
                }
            }
        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            me.$loadingOverlay.hide();
        }
    }
}