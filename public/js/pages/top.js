$(function() {
    /**
     * LINE通知日テキストボックス
     * 
     */
    let $txtSearchLineNoticeDate = $('#txtSearchLineNoticeDate');
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
     * LineNoticeGrid
     * 
     */
    let lineNoticeGrid;
    /**
     * LINE通知日の入力値
     * 
     */
    let searchLineNoticeDate = null;
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
            lineNoticeGrid = new LineNoticeGrid('lineNoticeGrid');

            // LINE通知情報の検索条件を設定
            setLineNoticeConditions();

            // 通知リストグリッドを初期化
            lineNoticeGrid.init(searchLineNoticeDate, searchLineNoticeType, searchLineDisplayName, searchUser);
        } catch(error) {
            throw error;
        }
    }

    /**
     * LINE通知情報の検索条件を設定
     * 
     */
    function setLineNoticeConditions() {
        // 通知日
        searchLineNoticeDate = null;
        if ($txtSearchLineNoticeDate.val() !== '') {
            searchLineNoticeDate = $txtSearchLineNoticeDate.val();
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
        // LINE通知情報の検索条件を設定
        setLineNoticeConditions();
        // 通知リストグリッドを設定
        lineNoticeGrid.setRowData(searchLineNoticeDate, searchLineNoticeType, searchLineDisplayName, searchUser);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // 通知リストグリッドを設定
        lineNoticeGrid.setRowData(searchLineNoticeDate, searchLineNoticeType, searchLineDisplayName, searchUser);
    });
});