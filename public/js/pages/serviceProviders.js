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
            setSearchConditions();
            initGrid();
            initServiceProviderInputModal();
        } catch(error) {
            throw error;
        }
    }

    /**
     * グリッドを初期化
     * 
     */
    function initGrid() {
        grid = new ServiceProviderGrid('grid');
        grid.init(txtProviderId, txtName, txtUseStartDateTime, txtUseEndDateTime, selServiceProviderUseStop);
    }

    /**
     * サービス提供者入力モーダルを初期化
     * 
     */
    function initServiceProviderInputModal() {
        serviceProviderInputModal = new ServiceProviderInputModal(
            new ServiceProviderInputModalCallbackClass(
                serviceProviderInputModalRegisterCallback,
                null,
                {
                    grid: grid
                }
            )
            ,'modalServiceProviderInputRegister'
        );
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
     * サービス提供者入力モーダル登録時コールバック
     * 
     * @param {object} data サービス提供者情報
     */
    function serviceProviderInputModalRegisterCallback(data) {
        // グリッドを設定
        this.context.grid.addRow(data);

        // ユーザー登録確認モーダルのインスタンスを生成
        confirmModal = new ConfirmModal(
            new ConfirmModalCallbackClass(
                userRegisterConfirmModalRegisterCallback,
                null,
                {
                    serviceProvider: data
                }
            )
            ,'userRegisterModalConfirm'
        )

        // ユーザー登録確認モーダルを起動
        confirmModal.show();
    }

    /**
     * ユーザー登録確認モーダルYesボタンコールバック
     * 
     * @param {Event} e 
     */
    function userRegisterConfirmModalRegisterCallback(e) {
        // モーダルを閉じる
        this.modal.close(e);

        // 担当者入力モーダルのインスタンスを生成
        userInputModal = new UserInputModal(null, 'modalUserInputRegister');

        // 担当者入力モーダルを初期化
        userInputModal.init();

        // 担当者種別にサービス提供者を設定し非表示
        userInputModal.$radioUserTypeServiceProvider.prop('checked', true);
        userInputModal.$userTypeContainer.hide();

        // サービス提供者IDを設定
        let selServiceProvider = new SelectBox(userInputModal.$selServiceProvider.attr('id'));
        selServiceProvider.addItem(this.context.serviceProvider.id, this.context.serviceProvider.name, true);

        // 担当者アカウント種別に管理者を設定し非表示
        userInputModal.$radioUserAccountTypeAdmin.prop('checked', true);
        userInputModal.$userAccountTypeContainer.hide();

        // 担当者入力モーダルを起動
        userInputModal.show();
    }

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(txtProviderId, txtName, txtUseStartDateTime, txtUseEndDateTime, selServiceProviderUseStop);
    });
});