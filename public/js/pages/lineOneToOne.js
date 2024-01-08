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
    let $selSearchServiceProvider = $('#selSearchServiceProvider');
    /**
     * 担当者セレクトボックス
     * 
     */
    let $selSearchUser = $('#selSearchUser');
    /**
     * LINE通知種別
     * 
     */
    let $selSearchLineAccountStatus = $('#selSearchLineAccountStatus');
    /**
     * LINE表示名テキストボックス
     * 
     */
    let $txtSearchLineDisplayName = $('#txtSearchLineDisplayName');
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
    let searchServiceProvider = null;
    /**
     * 担当者の選択値
     * 
     */
    let searchUser = null;
    /**
     * LINEアカウント状態の選択値
     * 
     */
    let searchLineAccountStatus = null;
    /**
     * LINE表示名の入力値
     * 
     */
    let searchLineDisplayName = null;


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
            grid.init(lineAccountTypeId, searchLineAccountStatus, searchLineDisplayName, searchServiceProvider, searchUser);
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
        searchServiceProvider = null;
        if ($selSearchServiceProvider.val() !== '0') {
            searchServiceProvider = Number($selSearchServiceProvider.val());
        }

        // 担当者セレクトボックス
        searchUser = null;
        if ($selSearchUser.val() !== '0') {
            searchUser = Number($selSearchUser.val());
        }

        // LINEアカウント状態セレクトボックス
        searchLineAccountStatus = null;
        if ($selSearchLineAccountStatus.val() !== '0') {
            searchLineAccountStatus = Number($selSearchLineAccountStatus.val());
        }

        // LINE表示名
        searchLineDisplayName = null;
        if (StringUtil.isInputBlank($txtSearchLineDisplayName.val()) !== '') {
            searchLineDisplayName = $txtSearchLineDisplayName.val().trim();
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
        grid.setRowData(lineAccountTypeId, searchLineAccountStatus, searchLineDisplayName, searchServiceProvider, searchUser);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(lineAccountTypeId, searchLineAccountStatus, searchLineDisplayName, searchServiceProvider, searchUser);
    });
});