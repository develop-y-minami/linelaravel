
$(function() {
    /**
     * エレメント
     * 
     */
    let $imgPictureUrl = $('#imgPictureUrl');         // プロフィール画像のURL
    let $tdLineBasicId = $('#tdLineBasicId');         // LINE ID
    let $tdLineDisplayName = $('#tdLineDisplayName'); // LINE アカウント名

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
            // LINE公式アカウント表示エリアを初期化
            initLineAccountContainer();
    
        } catch(error) {
            throw error;
        }
    }

    /**
     * LINE公式アカウント表示エリアを初期化
     * 
     */
    async function initLineAccountContainer() {
        try {
            // ボットの情報を設定する
            setLineBotInfo();
    
        } catch(error) {
            throw error;
        }
    }

    /**
     * ボットの情報を設定する
     * 
     */
    async function setLineBotInfo() {
        try {
            // ボットの情報を取得する
            let result = await LineApi.getBotInfo();

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // ボットのプロフィール画像のURLを設定する
                setPictureUrl(result.data.pictureUrl);
                // ボットのベーシックIDを設定する
                setLineBasicId(result.data.basicId);
                // ボットの表示名を設定する
                setLineDisplayName(result.data.displayName);

            }

        } catch(error) {
            throw error;
        }
    }

    /**
     * ボットのプロフィール画像のURLを設定する
     * 
     * @param {string} pictureUrl プロフィール画像のURL
     */
    function setPictureUrl(pictureUrl) {
        $imgPictureUrl.attr('src', pictureUrl);
    }

    /**
     * ボットのベーシックIDを設定する
     * 
     * @param {string} basicId ボットのベーシックID
     */
    function setLineBasicId(basicId) {
        $tdLineBasicId.text(basicId);
    }

    /**
     * ボットの表示名を設定する
     * 
     * @param {string} displayName ボットの表示名
     */
    function setLineDisplayName(displayName) {
        $tdLineDisplayName.text(displayName);
    }

});