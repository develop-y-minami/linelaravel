$(function() {
    /**
     * 担当者ID
     * 
     */
    $textUserId = $('#textUserId');
    /**
     * 担当者ID
     * 
     */
    userId = Number($textUserId.val());
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
            // LINEグリッドのインスタンスを生成
            lineGrid = new LineGrid('lineGrid');

            // LINEグリッドを初期化
            lineGrid.init(null, null, null, null, userId);
            lineGrid.hideColumns(['serviceProvider']);
        } catch(error) {
            throw error;
        }
    }
});