/**
 * 担当者種別
 * 
 */
let globalUserType;
/**
 * 担当者アカウント種別
 * 
 */
let globalUserAccountType;
/**
 * 担当者アカウント種別
 * 
 */
let globalPreviousUrl;

/**
 * 前ページに繊維
 * 
 */
function backPage() {
    window.location.href = globalPreviousUrl;
}

$(function() {
    /**
     * 担当者種別
     * 
     */
    let txtUserType = $('#txtUserType');
    /**
     * 担当者アカウント種別
     * 
     */
    let txtUserAccountType = $('#txtUserAccountType');
    /**
     * 前ページのURL
     * 
     */
    let txtPreviousUrl = $('#txtPreviousUrl');
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
            // グローバル変数に値を設定
            globalUserType = Number(txtUserType.val());
            globalUserAccountType = Number(txtUserAccountType.val());
            globalPreviousUrl = txtPreviousUrl.val();

            // インスタンスを生成
            lineOfficialAccountContainer = new LineOfficialAccountContainer()
    
            // 初期化処理を実行
            lineOfficialAccountContainer.init();
        } catch(error) {
            throw error;
        }
    }
});