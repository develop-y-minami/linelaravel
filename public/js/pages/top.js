$(function() {
    /**
     * LINE通知日テキストボックス
     * 
     */
    let $txtSearchLineNoticeDate = $('#txtSearchLineNoticeDate');
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
    let $selSearchLineNoticeType = $('#selSearchLineNoticeType');
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
     * Grid
     * 
     */
    let grid;
    /**
     * LINE通知日の入力値
     * 
     */
    let searchLineNoticeDate = null;
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
     * LINE通知種別の選択値
     * 
     */
    let searchLineNoticeType = null;
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
            grid = new LineNoticeGrid('grid');

            // 検索条件を設定
            setSearchConditions();

            // 通知リストグリッドを初期化
            grid.init(searchLineNoticeDate, searchLineNoticeType, searchLineDisplayName, searchServiceProvider, searchUser);
        } catch(error) {
            throw error;
        }
    }

    /**
     * 検索条件を設定
     * 
     */
    function setSearchConditions() {
        // 通知日
        searchLineNoticeDate = null;
        if ($txtSearchLineNoticeDate.val() !== '') {
            searchLineNoticeDate = $txtSearchLineNoticeDate.val();
        }

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

        // LINE通知種別セレクトボックス
        searchLineNoticeType = null;
        if ($selSearchLineNoticeType.val() !== '0') {
            searchLineNoticeType = Number($selSearchLineNoticeType.val());
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
        // 検索条件を設定
        setSearchConditions();
        // グリッドを設定
        grid.setRowData(searchLineNoticeDate, searchLineNoticeType, searchLineDisplayName, searchServiceProvider, searchUser);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(searchLineNoticeDate, searchLineNoticeType, searchLineDisplayName, searchServiceProvider, searchUser);
    });
});