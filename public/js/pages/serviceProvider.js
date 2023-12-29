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
     * callbackClass
     * 
     */
    let callbackClass;
    /**
     * サービス提供者入力モーダル
     * 
     */
    let serviceProviderInputModal;
    /**
     * 提供者IDの入力値
     * 
     */
    let searchProviderId = null;
    /**
     * 提供者名の入力値
     * 
     */
    let searchName = null;
    /**
     * サービス利用開始日の入力値
     * 
     */
    let searchUseStartDateTime = null;
    /**
     * サービス利用終了日の入力値
     * 
     */
    let searchUseEndDateTime = null;
    /**
     * サービス利用状態の選択値
     * 
     */
    let searchServiceProviderUseStop = null;

    /**
     * CallbackClass
     * 
     */
    class CallbackClass {

        /**
         * constructor
         * 
         */
        constructor() {};

        serviceProviderRegisterCallback() {
            
        }
    }

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
            grid = new ServiceProviderGrid('grid');
            callbackClass = new CallbackClass();
            serviceProviderInputModal = new ServiceProviderInputModal(callbackClass);

            // 検索条件を設定
            setSearchConditions();

            // 通知リストグリッドを初期化
            grid.init(searchProviderId, searchName, searchUseStartDateTime, searchUseEndDateTime, searchServiceProviderUseStop);
        } catch(error) {
            throw error;
        }
    }

    /**
     * 検索条件を設定
     * 
     */
    function setSearchConditions() {
        // 提供者ID
        searchProviderId = null;
        if (StringUtil.isInputBlank($txtProviderId.val()) !== '') {
            searchProviderId = $txtProviderId.val().trim();
        }

        // 提供者名
        searchName = null;
        if (StringUtil.isInputBlank($txtName.val()) !== '') {
            searchName = $txtName.val().trim();
        }

        // サービス利用開始日
        searchUseStartDateTime = null;
        if ($txtUseStartDateTime.val() !== '') {
            searchUseStartDateTime = $txtUseStartDateTime.val();
        }

        // サービス利用終了
        searchUseEndDateTime = null;
        if ($txtUseEndDateTime.val() !== '') {
            searchUseEndDateTime = $txtUseEndDateTime.val();
        }

        // サービス利用状態
        searchServiceProviderUseStop = null;
        if ($selServiceProviderUseStop.val() !== '') {
            searchServiceProviderUseStop = $selServiceProviderUseStop.val();
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
        grid.setRowData(searchProviderId, searchName, searchUseStartDateTime, searchUseEndDateTime, searchServiceProviderUseStop);
    });

    /**
     * 新規登録ボタンクリック時
     * 
     */
    $btnInsert.on('click', function() {
        // サービス提供者入力モーダルを起動
        serviceProviderInputModal.show(EditMode.REGISTER);
    });

    /**
     * リロードボタンクリック時
     * 
     */
    $btnReload.on('click', function() {
        // グリッドを設定
        grid.setRowData(searchProviderId, searchName, searchUseStartDateTime, searchUseEndDateTime, searchServiceProviderUseStop);
    });
});