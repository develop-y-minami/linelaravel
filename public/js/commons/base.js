
$(function() {
    /**
     * 公式LINEアカウント表示コンテナー
     * 
     */
    let lineOfficialAccountContainer;

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
            lineOfficialAccountContainer = new LineOfficialAccountContainer()
    
            // 初期化処理を実行
            lineOfficialAccountContainer.init();
        } catch(error) {
            throw error;
        }
    }
});