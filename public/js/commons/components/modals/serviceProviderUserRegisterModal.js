/**
 * ServiceProviderUserRegisterModal
 * 
 */
class ServiceProviderUserRegisterModal {
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
    $txtProviderId;
    /**
     * アカウント種別コンテナー
     * 
     */
    $radioUserAccountTypeContainer;
    /**
     * アカウント種別
     * 
     */
    $radioUserAccountType;
    /**
     * アカウント種別（一般）
     * 
     */
    $radioUserAccountTypeUser;
    /**
     * アカウント種別（管理者）
     * 
     */
    $radioUserAccountTypeAdmin;
    /**
     * アカウントID
     * 
     */
    $txtAccountId;
    /**
     * 名前
     * 
     */
    $txtName;
    /**
     * メールアドレス
     * 
     */
    $txtEmail;
    /**
     * パスワード
     * 
     */
    $txtPassword;
    /**
     * パスワード（確認入力）
     * 
     */
    $txtPasswordConfirm;
    /**
     * 登録ボタン
     * 
     */
    $btnRegister;
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
    constructor(callbackClass = null, id = 'modalServiceProviderUserRegister') {
        this.callbackClass = callbackClass;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + id + 'BtnClose');
        this.$txtProviderId = $('#' + id + 'TxtProviderId');
        this.$radioUserAccountTypeContainer = $('#' + id + 'RadioUserAccountTypeContainer');
        this.$radioUserAccountType = $('input:radio[name="' + id + 'RadioUserAccountType"]:checked');
        this.$radioUserAccountTypeUser = $('#' + id + 'RadioUserAccountTypeUser');
        this.$radioUserAccountTypeAdmin = $('#' + id + 'RadioUserAccountTypeAdmin');
        this.$txtAccountId = $('#' + id + 'TxtAccountId');
        this.$txtName = $('#' + id + 'TxtName');
        this.$txtEmail = $('#' + id + 'TxtEmail');
        this.$txtPassword = $('#' + id + 'TxtPassword');
        this.$txtPasswordConfirm = $('#' + id + 'TxtPasswordConfirm');
        this.$btnRegister = $('#' + id + 'BtnRegister');
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
        this.$txtAccountId.val('');
        this.$txtName.val('');
        this.$txtEmail.val('');
        this.$txtPassword.val('');
        this.$txtPasswordConfirm.val('');
        this.$radioUserAccountTypeUser.prop('checked', true);
    }

    /**
     * モーダルを表示
     * 
     */
    show() {
        // モーダルを初期化
        this.init();

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
            let providerId = me.$txtProviderId.val();
            let accountId = me.$txtAccountId.val().trim();
            let name = me.$txtName.val().trim();
            let email = me.$txtEmail.val().trim();
            let password = me.$txtPassword.val().trim();
            let passwordConfirm = me.$txtPasswordConfirm.val().trim();
            let userType = UserType.SERVICE_PROVIDER;
            let userAccountType = Number(me.$radioUserAccountType.val());
            
            // ユーザー情報を登録
            let result = await UserApi.register(providerId, accountId, name, email, password, passwordConfirm, userType, userAccountType);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                if (me.callbackClass !== null) {
                    // コールバックを実行
                    me.callbackClass.registerCallback();
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