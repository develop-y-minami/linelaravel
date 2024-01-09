$(function() {
    /**
     * LINEアカウント種別ID
     * 
     */
    let $txtLineAccountTypeId = $('#txtLineAccountTypeId');
    /**
     * サービス提供者セレクトボックス
     * 
     */
    let $selServiceProvider = $('#selServiceProvider');
    /**
     * 担当者セレクトボックス
     * 
     */
    let $selUser = $('#selUser');
    /**
     * LINE通知種別
     * 
     */
    let $selLineAccountStatus = $('#selLineAccountStatus');
    /**
     * LINE表示名テキストボックス
     * 
     */
    let $txtLineDisplayName = $('#txtLineDisplayName');
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
     * LINEアカウント種別ID
     * 
     */
    let lineAccountTypeId = Number($txtLineAccountTypeId.val());
    /**
     * サービス提供者の選択値
     * 
     */
    let selServiceProvider = null;
    /**
     * 担当者の選択値
     * 
     */
    let selUser = null;
    /**
     * LINEアカウント状態の選択値
     * 
     */
    let selLineAccountStatus = null;
    /**
     * LINE表示名の入力値
     * 
     */
    let txtLineDisplayName = null;


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
            grid = new LineGrid('grid');

            // 検索条件を設定
            setSearchConditions();

            // グリッドを初期化
            grid.init(lineAccountTypeId, selLineAccountStatus, txtLineDisplayName, selServiceProvider, selUser);
        } catch(error) {
            throw error;
        }
    }

    /**
     * LINE情報の検索条件を設定
     * 
     */
    function setSearchConditions() {
        // サービス提供者セレクトボックス
        selServiceProvider = null;
        if ($selServiceProvider.val() !== '0') {
            selServiceProvider = Number($selServiceProvider.val());
        }

        // 担当者セレクトボックス
        selUser = null;
        if ($selUser.val() !== '0') {
            selUser = Number($selUser.val());
        }

        // LINEアカウント状態セレクトボックス
        selLineAccountStatus = null;
        if ($selLineAccountStatus.val() !== '0') {
            selLineAccountStatus = Number($selLineAccountStatus.val());
        }

        // LINE表示名
        txtLineDisplayName = null;
        if (StringUtil.isInputBlank($txtLineDisplayName.val()) !== '') {
            txtLineDisplayName = $txtLineDisplayName.val().trim();
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
        grid.setRowData(lineAccountTypeId, selLineAccountStatus, txtLineDisplayName, selServiceProvider, selUser);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(lineAccountTypeId, selLineAccountStatus, txtLineDisplayName, selServiceProvider, selUser);
    });
});