$(function() {
    /**
     * LINE通知日テキストボックス
     * 
     */
    let $txtLineNoticeDate = $('#txtLineNoticeDate');
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
    let $selLineNoticeType = $('#selLineNoticeType');
    /**
     * LINE表示名テキストボックス
     * 
     */
    let $txtLineDisplayName = $('#txtLineDisplayName');
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
    let txtLineNoticeDate = null;
    /**
     * サービス提供者の選択値
     * 
     */
    let selServiceProvider = null;
    /**
     * 担当者の選択値
     * 
     */
    let searchUser = null;
    /**
     * LINE通知種別の選択値
     * 
     */
    let selLineNoticeType = null;
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
            grid = new LineNoticeGrid('grid');

            // 検索条件を設定
            setSearchConditions();

            // 通知リストグリッドを初期化
            grid.init(txtLineNoticeDate, selLineNoticeType, txtLineDisplayName, selServiceProvider, searchUser);
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
        txtLineNoticeDate = null;
        if ($txtLineNoticeDate.val() !== '') {
            txtLineNoticeDate = $txtLineNoticeDate.val();
        }

        // サービス提供者セレクトボックス
        selServiceProvider = null;
        if ($selServiceProvider.val() !== '0') {
            selServiceProvider = Number($selServiceProvider.val());
        }

        // 担当者セレクトボックス
        searchUser = null;
        if ($selUser.val() !== '0') {
            searchUser = Number($selUser.val());
        }

        // LINE通知種別セレクトボックス
        selLineNoticeType = null;
        if ($selLineNoticeType.val() !== '0') {
            selLineNoticeType = Number($selLineNoticeType.val());
        }

        // LINE表示名
        txtLineDisplayName = null;
        if (StringUtil.isInputBlank($txtLineDisplayName.val()) !== '') {
            txtLineDisplayName = $txtLineDisplayName.val().trim();
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
        grid.setRowData(txtLineNoticeDate, selLineNoticeType, txtLineDisplayName, selServiceProvider, searchUser);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(txtLineNoticeDate, selLineNoticeType, txtLineDisplayName, selServiceProvider, searchUser);
    });
});