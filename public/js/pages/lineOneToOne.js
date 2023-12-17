$(function() {
    /**
     * LINEアカウント種別ID
     * 
     */
    let $txtLineAccountTypeId = $('#txtLineAccountTypeId');
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
     * LineGrid
     * 
     */
    let lineGrid;
    /**
     * LINEアカウント種別ID
     * 
     */
    let lineAccountTypeId = Number($txtLineAccountTypeId.val());
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
            lineGrid = new LineGrid('lineGrid');

            // LINE情報の検索条件を設定
            setLineConditions();

            // LINEリストグリッドを初期化
            lineGrid.init(lineAccountTypeId, searchLineAccountStatus, searchLineDisplayName, searchUser);
        } catch(error) {
            throw error;
        }
    }

    /**
     * LINE情報の検索条件を設定
     * 
     */
    function setLineConditions() {
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
     * 検索ボタンクリック時
     * 
     */
    $btnSearch.on('click', function() {
        // LINE情報の検索条件を設定
        setLineConditions();
        // LINEリストグリッドを設定
        lineGrid.setRowData(lineAccountTypeId, searchLineAccountStatus, searchLineDisplayName, searchUser);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // LINEリストグリッドを設定
        lineGrid.setRowData(lineAccountTypeId, searchLineAccountStatus, searchLineDisplayName, searchUser);
    });
});