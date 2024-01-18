$(function() {
    /**
     * 担当者種別セレクトボックス
     * 
     */
    let $selUserType = $('#selUserType');
    /**
     * サービス提供者セレクトボックス
     * 
     */
    let $selServiceProvider = $('#selServiceProvider');
    /**
     * 担当者アカウント種別セレクトボックス
     * 
     */
    let $selUserAccountType = $('#selUserAccountType');
    /**
     * アカウントIDテキストボックス
     * 
     */
    let $txtAccountId = $('#txtAccountId');
    /**
     * 担当者名テキストボックス
     * 
     */
    let $txtName = $('#txtName');
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
     * 担当者種別セレクトボックスの選択値
     * 
     */
    let selUserType = null;
    /**
     * サービス提供者セレクトボックスの選択値
     * 
     */
    let selServiceProvider = null;
    /**
     * 担当者アカウント種別セレクトボックスの選択値
     * 
     */
    let selUserAccountType = null;
    /**
     * アカウントIDテキストボックスの入力値
     * 
     */
    let txtAccountId = null;
    /**
     * 担当者名テキストボックスの入力値
     * 
     */
    let txtName = null;
    /**
     * Grid
     * 
     */
    let grid = new UserGrid('grid').create();

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
            userType : selUserType,
            serviceProviderId : selServiceProvider,
            userAccountType : selUserAccountType,
            accountId : txtAccountId,
            name : txtName
        });
    }

    /**
     * 検索条件を設定
     * 
     */
    function setSearchConditions() {
        // 担当者種別
        selUserType = null;
        if ($selUserType.val() !== '0') {
            selUserType = $selUserType.val();
        }

        // サービス提供者
        selServiceProvider = null;
        if ($selServiceProvider.val() !== '0') {
            selServiceProvider = $selServiceProvider.val();
        }

        // 担当者アカウント種別
        selUserAccountType = null;
        if ($selUserAccountType.val() !== '0') {
            selUserAccountType = $selUserAccountType.val();
        }

        // アカウントID
        txtAccountId = null;
        if (StringUtil.isInputBlank($txtAccountId.val()) !== '') {
            txtAccountId = $txtAccountId.val().trim();
        }

        // 担当者名
        txtName = null;
        if (StringUtil.isInputBlank($txtName.val()) !== '') {
            txtName = $txtName.val().trim();
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
        // 担当者入力モーダルを起動
        new UserInputModal(
            new UserInputModalCallbackClass(
                userInputModalRegisterCallback,
                null,
                {
                    grid : grid
                }
            )
            ,'modalUserInputRegister'
        ).init().show();
    });

    /**
     * 担当者入力モーダル登録時コールバック
     * 
     * @param {object} data 担当者情報
     */
    function userInputModalRegisterCallback(data) {
        // グリッドを設定
        this.context.grid.addRow(data);
    }
});