$(function() {
    /**
     * LINE情報ID
     * 
     */
    let $txtLineId = $('#txtLineId');
    /**
     * 担当者名
     * 
     */
    let $userName = $('#userName');
    /**
     * 担当者設定ボタン
     * 
     */
    let $btnLineOfUserSetting = $('#btnLineOfUserSetting');
    /**
     * 左オーバーレイ
     * 
     */
    let $leftOverlay = $('#leftOverlay');
    /**
     * LINE担当者設定モーダル
     * 
     */
    let lineOfUserSettingModal;
    /**
     * LINE情報コンテナー
     * 
     */
    let lineContainer;
    /**
     * LINE情報ID
     * 
     */
    let lineId = Number($txtLineId.val());

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
            lineOfUserSettingModal = new LineOfUserSettingModal(lineId, $leftOverlay, lineOfUserSettingCallback);
            lineContainer = new LineContainer(lineId, $leftOverlay);
        } catch(error) {
            throw error;
        }
    }

    /**
     * 担当者設定時のコールバック
     * 
     * @param {number} userId   担当者ID
     * @param {string} userName 担当者名
     */
    function lineOfUserSettingCallback(userId, userName) {
        // 担当者名を設定
        if (userId === 0) {
            $userName.html('');
        } else {
            $userName.html(userName);
        }
    }

    /**
     * 担当者設定ボタンクリック時
     * 
     */
    $btnLineOfUserSetting.on('click', function() {
        // LINE担当者設定モーダルを表示
        lineOfUserSettingModal.show();
    });
});