$(function() {
    /**
     * 提供者テキストボックス
     * 
     */
    let $txtProviderId = $('#txtProviderId');
    /**
     * 提供者名テキストボックス
     * 
     */
    let $txtName = $('#txtName');
    /**
     * サービス利用開始日テキストボックス
     * 
     */
    let $txtUseStartDateTime = $('#txtUseStartDateTime');
    /**
     * サービス利用終了日テキストボックス
     * 
     */
    let $txtUseEndDateTime = $('#txtUseEndDateTime');
    /**
     * サービス利用状態セレクトボックス
     * 
     */
    let $selServiceProviderUseStop = $('#selServiceProviderUseStop');
    /**
     * 表示モード切替
     * 
     */
    let $checkSwitch = $('#checkSwitch');
    /**
     * 検索ボタン
     * 
     */
    let $btnSearch = $('#btnSearch');
    /**
     * 新規登録ボタン
     * 
     */
    let $btnInsert = $('#btnInsert');
    /**
     * リロードボタン
     * 
     */
    let $btnReload = $('#btnReload');
    /**
     * Grid
     * 
     */
    let grid;
    /**
     * サービス提供者入力モーダル
     * 
     */
    let serviceProviderInputModal;
    /**
     * ユーザー登録確認モーダル
     * 
     */
    let userRegisterConfirmModal;
    /**
     * サービス提供者ユーザー登録モーダル
     * 
     */
    let serviceProviderUserRegisterModal;
    /**
     * 提供者IDの入力値
     * 
     */
    let txtProviderId = null;
    /**
     * 提供者名の入力値
     * 
     */
    let txtName = null;
    /**
     * サービス利用開始日の入力値
     * 
     */
    let txtUseStartDateTime = null;
    /**
     * サービス利用終了日の入力値
     * 
     */
    let txtUseEndDateTime = null;
    /**
     * サービス利用状態の選択値
     * 
     */
    let selServiceProviderUseStop = null;

    /**
     * ServiceProviderInputRegisterModalCallbackClass
     * 
     */
    class ServiceProviderInputRegisterModalCallbackClass {
        /**
         * constructor
         * 
         */
        constructor() {};

        /**
         * サービス提供者登録時コールバック
         * 
         * @param {object} serviceProvider サービス提供者情報
         */
        registerCallback(serviceProvider) {
            // グリッドを設定
            grid.addRow(serviceProvider);
            // contextにサービス提供者情報を設定
            userRegisterConfirmModal.setContext(serviceProvider);
            // ユーザー登録確認モーダルを起動
            userRegisterConfirmModal.show();
        }
    }

    /**
     * UserRegisterConfirmModalCallbackClass
     * 
     */
    class UserRegisterConfirmModalCallbackClass {
        /**
         * constructor
         * 
         */
        constructor() {};

        /**
         * Yesボタンクリック時
         * 
         * @param {Event} e
         */
        yesCallback(e) {
            e.data.me.close(e);
            // サービス提供者情報を取得
            let serviceProvider = e.data.me.context;

            // サービス提供者ユーザー登録モーダルを初期化
            serviceProviderUserRegisterModal.init();

            // 管理者をチェック状態に設定し非表示
            serviceProviderUserRegisterModal.$radioUserAccountTypeAdmin.prop('checked', true);
            serviceProviderUserRegisterModal.$radioUserAccountTypeContainer.hide();

            // サービス提供者IDを設定
            serviceProviderUserRegisterModal.$txtServiceProviderId.val(serviceProvider.id);

            // サービス提供者ユーザー登録モーダルを起動
            serviceProviderUserRegisterModal.show();
        }

        /**
         * Noボタンクリック時
         * 
         * @param {Event} e
         */
        noCallback(e) {
            e.data.me.close(e);
        }
    }

    try {
        // 初期化処理を実行
        init();

    } catch(error) {
        console.error(error);
    }

    /**
     * 初期化処理
     * 
     */
    function init() {
        try {
            // インスタンスを生成
            grid = new ServiceProviderGrid('grid');

            // サービス提供者入力モーダル
            serviceProviderInputModal = new ServiceProviderInputModal(new ServiceProviderInputRegisterModalCallbackClass(), 'modalServiceProviderInputRegister');

            // サービス提供者ユーザー登録確認モーダル
            userRegisterConfirmModal = new ConfirmModal(new UserRegisterConfirmModalCallbackClass(), 'userRegisterModalConfirm');

            // サービス提供者ユーザー登録モーダル
            serviceProviderUserRegisterModal = new ServiceProviderUserRegisterModal();

            // 検索条件を設定
            setSearchConditions();

            // 通知リストグリッドを初期化
            grid.init(txtProviderId, txtName, txtUseStartDateTime, txtUseEndDateTime, selServiceProviderUseStop);
        } catch(error) {
            throw error;
        }
    }

    /**
     * 検索条件を設定
     * 
     */
    function setSearchConditions() {
        // 提供者ID
        txtProviderId = null;
        if (StringUtil.isInputBlank($txtProviderId.val()) !== '') {
            txtProviderId = $txtProviderId.val().trim();
        }

        // 提供者名
        txtName = null;
        if (StringUtil.isInputBlank($txtName.val()) !== '') {
            txtName = $txtName.val().trim();
        }

        // サービス利用開始日
        txtUseStartDateTime = null;
        if ($txtUseStartDateTime.val() !== '') {
            txtUseStartDateTime = $txtUseStartDateTime.val();
        }

        // サービス利用終了
        txtUseEndDateTime = null;
        if ($txtUseEndDateTime.val() !== '') {
            txtUseEndDateTime = $txtUseEndDateTime.val();
        }

        // サービス利用状態
        selServiceProviderUseStop = null;
        if ($selServiceProviderUseStop.val() !== '') {
            selServiceProviderUseStop = $selServiceProviderUseStop.val();
        }
    }

    /**
     * 表示モード切替
     * 
     */
    $checkSwitch.on('change', function() {
        if ($(this).prop('checked') === true) {
            grid.showDetailInfoMode();
        } else {
            grid.showGridMode();
        }
    })

    /**
     * 検索ボタンクリック時
     * 
     */
    $btnSearch.on('click', function() {
        // 検索条件を設定
        setSearchConditions();
        // グリッドを設定
        grid.setRowData(txtProviderId, txtName, txtUseStartDateTime, txtUseEndDateTime, selServiceProviderUseStop);
    });

    /**
     * 新規登録ボタンクリック時
     * 
     */
    $btnInsert.on('click', function() {
        // サービス提供者入力モーダルを起動
        serviceProviderInputModal.init();
        serviceProviderInputModal.show();
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(txtProviderId, txtName, txtUseStartDateTime, txtUseEndDateTime, selServiceProviderUseStop);
    });
});