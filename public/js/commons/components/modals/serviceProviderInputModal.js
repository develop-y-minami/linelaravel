/**
 * ServiceProviderInputModalCallbackClass
 * 
 * サービス提供者情報入力モーダルコールバック
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
 * サービス提供者情報入力モーダル
 * 
 */
class ServiceProviderInputModal extends Modal {
    /**
     * ボタンクリック時のコールバック先クラス
     * 
     */
    callbackClass;
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
    $txtUseStartDate;
    /**
     * 利用終了日
     * 
     */
    $txtUseEndDate;
    /**
     * 使用状態
     * 
     */
    $checkUseStopFlg;
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
        super(id);
        this.callbackClass = callbackClass;
        this.$txtServiceProviderId = $('#' + id + 'TxtServiceProviderId');
        this.$txtProviderId = $('#' + id + 'TxtProviderId');
        this.$txtName = $('#' + id + 'TxtName');
        this.$txtUseStartDate = $('#' + id + 'TxtUseStartDate');
        this.$txtUseEndDate = $('#' + id + 'TxtUseEndDate');
        this.$checkUseStopFlg = $('#' + id + 'CheckUseStopFlg');
        this.$btnRegister = $('#' + id + 'BtnRegister');
        this.$btnUpdate = $('#' + id + 'BtnUpdate');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // イベントを設定
        this.$btnRegister.on('click', { me : this }, this.clickBtnRegister);
        this.$btnUpdate.on('click', { me : this }, this.clickBtnUpdate);
    }

    /**
     * モーダルを初期化
     * 
     * @returns {Modal} this
     */
    init() {
        this.$txtServiceProviderId.val('');
        this.$txtProviderId.val('');
        this.$txtName.val('');
        this.$txtUseStartDate.val(DateTimeUtil.today());
        this.$txtUseEndDate.val('');
        this.$checkUseStopFlg.prop('checked', false);

        return this;
    }

    /**
     * サービス提供者情報を設定
     * 
     * @param {number}  serviceProviderId サービス提供者情報ID
     * @param {string}  providerId        提供者ID
     * @param {string}  name              提供者名
     * @param {string}  useStartDate  サービス利用開始日
     * @param {string}  useEndDate    サービス利用終了日
     * @param {boolean} useStopFlg           利用停止
     * @returns {Modal} this
     */
    set(
        serviceProviderId,
        providerId,
        name,
        useStartDate,
        useEndDate,
        useStopFlg
        ) {
        this.$txtServiceProviderId.val(serviceProviderId);
        this.$txtProviderId.val(providerId);
        this.$txtName.val(name);
        this.$txtUseStartDate.val(useStartDate);
        this.$txtUseEndDate.val(useEndDate);
        this.$checkUseStopFlg.prop('checked', useStopFlg);

        return this;
    }

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
            let useStartDate = me.$txtUseStartDate.val();
            let useEndDate = me.$txtUseEndDate.val();

            // サービス提供者情報を登録
            let result = await ServiceProviderApi.register(providerId, name, useStartDate, useEndDate);

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
            let useStartDate = me.$txtUseStartDate.val();
            let useEndDate = me.$txtUseEndDate.val();
            let useStopFlg = me.$checkUseStopFlg.prop('checked');

            // サービス提供者情報を更新
            let result = await ServiceProviderApi.update(serviceProviderId, providerId, name, useStartDate, useEndDate, useStopFlg);

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