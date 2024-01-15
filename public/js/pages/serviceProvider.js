$(function() {
    /**
     * サービス提供者ID
     * 
     */
    $textServiceProviderId = $('#textServiceProviderId');
    /**
     * サービス提供者ID
     * 
     */
    serviceProviderId = Number($textServiceProviderId.val());
    /**
     * 担当者グリッド
     * 
     */
    let userGrid;
    /**
     * LINEグリッド
     * 
     */
    let lineGrid;

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
            // 担当者グリッドのインスタンスを生成
            userGrid = new UserGrid('userGrid');
            // LINEグリッドのインスタンスを生成
            lineGrid = new LineGrid('lineGrid');

            // 担当者グリッドを初期化
            userGrid.init(null, serviceProviderId, null, null, null);
            userGrid.hideColumns(['userType.name', 'serviceProvider', 'btnEdit', 'btnDelete']);
            // LINEグリッドを初期化
            lineGrid.init(null, null, null, serviceProviderId, null);
            lineGrid.hideColumns(['serviceProvider']);
        } catch(error) {
            throw error;
        }
    }
});