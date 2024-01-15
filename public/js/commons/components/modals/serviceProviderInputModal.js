/**
 * ServiceProviderInputModalCallbackClass
 * 
 */
class ServiceProviderInputModalCallbackClass {
    /**
     * constructor
     * 
     * @param {Function} registerCallbackProc 登録ボタンクリック時コールバック
     * @param {Function} updateCallbackProc   更新ボタンクリック時コールバック
     * @param {object}   context              context
     */
    constructor(registerCallbackProc = null, updateCallbackProc = null, context = null) {
        this.registerCallbackProc = registerCallbackProc;
        this.updateCallbackProc = updateCallbackProc;
        this.context = context;
    };

    /**
     * サービス提供者登録時コールバック
     * 
     * @param {object} data サービス提供者情報
     */
    registerCallback(data) {
        if (this.registerCallbackProc != null) {
            this.registerCallbackProc(data);
        }
    }

    /**
     * サービス提供者更新時コールバック
     * 
     * @param {object} data サービス提供者情報
     */
    updateCallback(data) {
        if (this.updateCallbackProc != null) {
            this.updateCallbackProc(data);
        }
    }
}

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
     * サービス提供者情報ID
     * 
     */
    $txtServiceProviderId;
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
        this.$txtServiceProviderId = $('#' + id + 'TxtServiceProviderId');
        this.$txtProviderId = $('#' + id + 'TxtProviderId');
        this.$txtName = $('#' + id + 'TxtName');
        this.$txtUseStartDateTime = $('#' + id + 'TxtUseStartDateTime');
        this.$txtUseEndDateTime = $('#' + id + 'TxtUseEndDateTime');
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
        this.$btnUpdate.on('click', { me : this }, this.clickBtnUpdate);
    }

    /**
     * モーダルを初期化
     * 
     */
    init() {
        this.$txtServiceProviderId.val('');
        this.$txtProviderId.val('');
        this.$txtName.val('');
        this.$txtUseStartDateTime.val(DateTimeUtil.getToday());
        this.$txtUseEndDateTime.val('');
        this.$checkUseStop.prop('checked', false);
    }

    /**
     * サービス提供者情報を設定
     * 
     * @param {number}  serviceProviderId サービス提供者情報ID
     * @param {string}  providerId        提供者ID
     * @param {string}  name              提供者名
     * @param {string}  useStartDateTime  サービス利用開始日
     * @param {string}  useEndDateTime    サービス利用終了日
     * @param {boolean} useStop           利用停止
     */
    set(
        serviceProviderId,
        providerId,
        name,
        useStartDateTime,
        useEndDateTime,
        useStop
        ) {
        this.$txtServiceProviderId.val(serviceProviderId);
        this.$txtProviderId.val(providerId);
        this.$txtName.val(name);
        this.$txtUseStartDateTime.val(useStartDateTime);
        this.$txtUseEndDateTime.val(useEndDateTime);
        this.$checkUseStop.prop('checked', useStop);
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
                    me.callbackClass.registerCallback(result.data.serviceProvider);
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

    /**
     * 更新ボタンクリック時
     * 
     * @param {Event} e 
     */
    async clickBtnUpdate(e) {
        let me = e.data.me;

        try {
            // エラーメッセージを非表示
            me.errorMessage.hide();

            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

            // パラメータを取得
            let serviceProviderId = Number(me.$txtServiceProviderId.val());
            let providerId = me.$txtProviderId.val().trim();
            let name = me.$txtName.val().trim();
            let useStartDateTime = me.$txtUseStartDateTime.val();
            let useEndDateTime = me.$txtUseEndDateTime.val();
            let useStop = me.$checkUseStop.prop('checked');

            // サービス提供者情報を更新
            let result = await ServiceProviderApi.update(serviceProviderId, providerId, name, useStartDateTime, useEndDateTime, useStop);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                if (me.callbackClass !== null) {
                    // コールバックを実行
                    me.callbackClass.updateCallback(result.data.serviceProvider);
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