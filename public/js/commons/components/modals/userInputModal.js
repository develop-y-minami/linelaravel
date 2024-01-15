/**
 * UserInputUpdateModalCallbackClass
 * 
 */
class UserInputUpdateModalCallbackClass {
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
     * 担当者登録時コールバック
     * 
     * @param {object} data 担当者情報
     */
    registerCallback(data) {
        if (this.registerCallbackProc != null) {
            this.registerCallbackProc(data);
        }
    }

    /**
     * 担当者更新時コールバック
     * 
     * @param {object} data 担当者情報
     */
    updateCallback(data) {
        if (this.updateCallbackProc != null) {
            this.updateCallbackProc(data);
        }
    }
}

/**
 * UserInputModal
 * 
 */
class UserInputModal {
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
     * 担当者情報ID
     * 
     */
    $txtUserId;
    /**
     * 担当者種別コンテナー
     * 
     */
    $userTypeContainer;
    /**
     * 担当者種別
     * 
     */
    $radioUserType;
    /**
     * 担当者種別：運用者
     * 
     */
    $radioUserTypeOperator;
    /**
     * 担当者種別：サービス提供者
     * 
     */
    $radioUserTypeServiceProvider;
    /**
     * サービス提供者コンテナー
     * 
     */
    $serviceProviderContainer;
    /**
     * サービス提供者
     * 
     */
    $selServiceProvider;
    /**
     * 担当者アカウント種別コンテナー
     * 
     */
    $userAccountTypeContainer;
    /**
     * 担当者アカウント種別
     * 
     */
    $radioUserAccountType;
    /**
     * 担当者アカウント種別：一般
     * 
     */
    $radioUserAccountTypeUser;
    /**
     * 担当者アカウント種別：管理者
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
     * プロフィール画像ファイル名
     * 
     */
    $txtProfileImageName;
    /**
     * プロフィール画像
     * 
     */
    $fileProfileImage;
    /**
     * プロフィール画像エラー
     * 
     */
    $profileImageError;
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
     * プロフィール画像：base64
     * 
     */
    profileImage;

    /**
     * constructor
     * 
     * @param {class}  callbackClass ボタンクリック時のコールバック先クラス
     * @param {string} id            モーダルID
     */
    constructor(callbackClass = null, id = 'modalUserInput') {
        this.callbackClass = callbackClass;
        this.$modal = $('#' + id);
        this.$btnClose = $('#' + id + 'BtnClose');
        this.$txtUserId = $('#' + id + 'TxtUserId');
        this.$userTypeContainer = $('#' + id + 'UserTypeContainer');
        this.$radioUserType = $('input:radio[name="' + id + 'RadioUserType"]');
        this.$radioUserTypeOperator = $('#' + id + 'RadioUserType' + UserType.OPERATOR);
        this.$radioUserTypeServiceProvider = $('#' + id + 'RadioUserType' + UserType.SERVICE_PROVIDER);
        this.$serviceProviderContainer = $('#' + id + 'ServiceProviderContainer');
        this.$selServiceProvider = $('#' + id + 'SelServiceProvider');
        this.$userAccountTypeContainer = $('#' + id + 'UserAccountTypeContainer');
        this.$radioUserAccountType = $('input:radio[name="' + id + 'RadioUserAccountType"]');
        this.$radioUserAccountTypeUser = $('#' + id + 'RadioUserAccountType' + UserAccountType.USER);
        this.$radioUserAccountTypeAdmin = $('#' + id + 'RadioUserAccountType' + UserAccountType.ADMIN);
        this.$txtAccountId = $('#' + id + 'TxtAccountId');
        this.$txtName = $('#' + id + 'TxtName');
        this.$txtEmail = $('#' + id + 'TxtEmail');
        this.$txtPassword = $('#' + id + 'TxtPassword');
        this.$txtPasswordConfirm = $('#' + id + 'TxtPasswordConfirm');
        this.$txtProfileImageName = $('#' + id + 'TxtProfileImageName');
        this.$fileProfileImage = $('#' + id + 'FileProfileImage');
        this.$profileImageError = $('#' + id + 'ProfileImageError');
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
        this.$radioUserType.on('change', { me : this }, this.changeRadioUserType);
        this.$fileProfileImage.on('change', { me : this }, this.changeFileProfileImage);
        this.$btnRegister.on('click', { me : this }, this.clickBtnRegister);
        this.$btnUpdate.on('click', { me : this }, this.clickBtnUpdate);
    }

    /**
     * モーダルを初期化
     * 
     */
    init() {
        if (globalUserType == UserType.OPERATOR)
        {
            // 担当者種別が運用者の場合に初期化
            this.$radioUserTypeOperator.prop('checked', true);
            this.$selServiceProvider.val('0');
            this.$serviceProviderContainer.hide();
        }
        this.$radioUserAccountTypeUser.prop('checked', true);
        this.$txtAccountId.val('');
        this.$txtName.val('');
        this.$txtEmail.val('');
        this.$txtPassword.val('');
        this.$txtPasswordConfirm.val('');
        this.clearProfileImage(this);
    }

    /**
     * 担当者情報を設定
     * 
     * @param {number} userId            担当者ID
     * @param {number} userType          担当者種別
     * @param {number} serviceProviderId サービス提供者ID
     * @param {number} userAccountType   担当者アカウント種別
     * @param {string} accountId         アカウントID
     * @param {string} name              担当者名
     * @param {string} email             メールアドレス
     */
    set(
        userId,
        userType,
        serviceProviderId,
        userAccountType,
        accountId,
        name,
        email
        ) {
        this.$txtUserId.val(userId);
        if (userType === UserType.OPERATOR) {
            this.$radioUserTypeOperator.prop('checked', true);
            this.$serviceProviderContainer.hide();
        } else {
            this.$radioUserTypeServiceProvider.prop('checked', true);
            this.$serviceProviderContainer.show();
        }
        if (serviceProviderId === null) {
            this.$selServiceProvider.val('0');
        } else {
            this.$selServiceProvider.val(serviceProviderId);
        }
        if (userAccountType === UserAccountType.USER) {
            this.$radioUserAccountTypeUser.prop('checked', true);
        } else {
            this.$radioUserAccountTypeAdmin.prop('checked', true);
        }
        this.$txtAccountId.val(accountId);
        this.$txtName.val(name);
        this.$txtEmail.val(email);
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
     * 担当者種別変更時
     * 
     * @param {Event} e 
     */
    changeRadioUserType(e) {
        let me = e.data.me;

        // 選択した担当者種別を取得
        let userType = Number($(this).filter(':checked').val());

        // サービス提供者の表示/非表示を変更
        if (userType === UserType.OPERATOR) {
            me.$serviceProviderContainer.slideUp();
        } else {
            me.$serviceProviderContainer.slideDown();
        }
    }

    /**
     * プロフィール画像変更時
     * 
     * @param {Event} e 
     */
    async changeFileProfileImage(e) {
        let me = e.data.me;

        // プロフィール画像をクリア
        me.clearProfileImage(me);

        // ファイルを取得
        let file = $(this)[0].files[0];

        if (file !== undefined) {
            // ファイルをbase64データで取得
            let result = await FileUtil.readAsDataURL(file);

            if (result.status === FileUtil.READ_RESULT_STATUS_OK) {
                // ファイル名を設定
                me.$txtProfileImageName.val(file.name);
                // base64データを設定
                me.profileImage = result.url;
            } else {
                // 取得失敗
                me.$profileImageError.fadeIn();
                me.$profileImageError.html(result.error);
            }

        }
    }

    /**
     * プロフィール画像をクリア
     * 
     * @param {UserInputModal} me this
     */
    clearProfileImage(me) {
        me.$txtProfileImageName.val('');
        me.$fileProfileImage = null;
        me.profileImage = null;
        me.$profileImageError.fadeOut();
        me.$profileImageError.html('');
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
            let userType = Number(me.$radioUserType.filter(':checked').val());
            let serviceProviderId = null;
            if (userType === UserType.SERVICE_PROVIDER && me.$selServiceProvider.val() !== '0') {
                // 担当者種別がサービス提供者の場合に設定
                serviceProviderId = Number(me.$selServiceProvider.val());
            }
            let userAccountType = Number(me.$radioUserAccountType.filter(':checked').val());
            let accountId = me.$txtAccountId.val().trim();
            let name = me.$txtName.val().trim();
            let email = me.$txtEmail.val().trim();
            let password = me.$txtPassword.val().trim();
            let passwordConfirm = me.$txtPasswordConfirm.val().trim();
            let profileImage = me.profileImage;
            
            // ユーザー情報を登録
            let result = await UserApi.register(userType, serviceProviderId, userAccountType, accountId, name, email, password, passwordConfirm, profileImage);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                if (me.callbackClass !== null) {
                    // コールバックを実行
                    me.callbackClass.registerCallback(result.data.user);
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
            let userId = Number(me.$txtUserId.val());
            let userType = Number(me.$radioUserType.filter(':checked').val());
            let serviceProviderId = null;
            if (userType === UserType.SERVICE_PROVIDER && me.$selServiceProvider.val() !== '0') {
                // 担当者種別がサービス提供者の場合に設定
                serviceProviderId = Number(me.$selServiceProvider.val());
            }
            let userAccountType = Number(me.$radioUserAccountType.filter(':checked').val());
            let accountId = me.$txtAccountId.val().trim();
            let name = me.$txtName.val().trim();
            let email = me.$txtEmail.val().trim();

            // サービス提供者情報を更新
            let result = await UserApi.update(userId, userType, serviceProviderId, userAccountType, accountId, name, email);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                if (me.callbackClass !== null) {
                    // コールバックを実行
                    me.callbackClass.updateCallback(result.data.user);
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