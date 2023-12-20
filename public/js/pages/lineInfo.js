$(function() {
    /**
     * LINE情報コンテナー
     * 
     */
    let lineInfoContainer;

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
            lineInfoContainer = new LineInfoContainer();
        } catch(error) {
            throw error;
        }
    }
});