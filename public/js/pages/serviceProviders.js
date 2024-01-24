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
     * 利用開始日テキストボックス
     * 
     */
    let $txtUseStartDate = $('#txtUseStartDate');
    /**
     * 利用終了日テキストボックス
     * 
     */
    let $txtUseEndDate = $('#txtUseEndDate');
    /**
     * 利用停止フラグセレクトボックス
     * 
     */
    let $selServiceProviderUseStopFlg = $('#selServiceProviderUseStopFlg');
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
    let grid = new ServiceProviderGrid('grid').create();
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
     * 利用開始日の入力値
     * 
     */
    let txtUseStartDate = null;
    /**
     * 利用終了日の入力値
     * 
     */
    let txtUseEndDate = null;
    /**
     * 利用停止フラグの選択値
     * 
     */
    let selServiceProviderUseStopFlg = null;

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
    function init() { setGrid(); }

    /**
     * 検索ボタンクリック時
     * 
     */
    $btnSearch.on('click', function() { setGrid(); });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() { setGrid(); });

    /**
     * グリッドを設定
     * 
     */
    function setGrid() {
        // 検索条件を設定
        setSearchConditions();
        // 行データを設定
        grid.setRowData({
            providerId : txtProviderId,
            name : txtName,
            useStartDate : txtUseStartDate,
            useEndDate : txtUseEndDate,
            useStopFlg : selServiceProviderUseStopFlg
        });
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

        // 利用開始日
        txtUseStartDate = null;
        if ($txtUseStartDate.val() !== '') {
            txtUseStartDate = $txtUseStartDate.val();
        }

        // サービス利用終了
        txtUseEndDate = null;
        if ($txtUseEndDate.val() !== '') {
            txtUseEndDate = $txtUseEndDate.val();
        }

        // 利用停止フラグ
        selServiceProviderUseStopFlg = null;
        if ($selServiceProviderUseStopFlg.val() !== '') {
            selServiceProviderUseStopFlg = $selServiceProviderUseStopFlg.val();
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
     * 新規登録ボタンクリック時
     * 
     */
    $btnInsert.on('click', function() {
        // サービス提供者入力モーダルを起動
        new ServiceProviderInputModal(
            new ServiceProviderInputModalCallbackClass(
                serviceProviderInputModalRegisterCallback,
                null,
                {
                    grid: grid
                }
            )
            ,'modalServiceProviderInputRegister'
        ).init().show();
    });

    /**
     * サービス提供者入力モーダル登録時コールバック
     * 
     * @param {object} data サービス提供者情報
     */
    function serviceProviderInputModalRegisterCallback(data) {
        // グリッドを設定
        this.context.grid.addRow(data);

        // ユーザー登録確認モーダルを起動
        new ConfirmModal(
            new ConfirmModalCallbackClass(
                userRegisterConfirmModalRegisterCallback,
                null,
                {
                    serviceProvider: data
                }
            )
            ,'userRegisterModalConfirm'
        ).show();
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
        userInputModal = new UserInputModal(null, 'modalUserInputRegister').init();

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
});