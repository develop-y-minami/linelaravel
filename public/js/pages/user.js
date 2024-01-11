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
    let grid;

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
        // インスタンスを生成
        grid = new UserGrid('grid');

        // 検索条件を設定
        setSearchConditions();

        // 担当者グリッドを初期化
        grid.init(selUserType, selServiceProvider, selUserAccountType, txtAccountId, txtName);
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
});