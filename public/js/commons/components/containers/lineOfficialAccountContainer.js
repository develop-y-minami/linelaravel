/**
 * LineOfficialAccountContainer
 * 
 */
class LineOfficialAccountContainer {
    /**
     * プロフィール画像
     * 
     */
    $imgOfficialAccountPictureUrl;
    /**
     * LINE ID
     * 
     */
    $tdLineOfficialAccountBasicId;
    /**
     * アカウント名
     * 
     */
    $tdLineOfficialAccountDisplayName;

    /**
     * constructor
     * 
     */
    constructor() {
        this.$imgOfficialAccountPictureUrl = $('#imgOfficialAccountPictureUrl');
        this.$tdLineOfficialAccountBasicId = $('#tdLineOfficialAccountBasicId');
        this.$tdLineOfficialAccountDisplayName = $('#tdLineOfficialAccountDisplayName');
    }

    /**
     * 初期化処理
     * 
     */
    async init() {
        try {
            // API経由でボットの情報を取得
            let result = await LineMessagingApi.botInfo();

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // 取得したデータをコンテナーに設定
                this.setLineOfficialAccountContainer(
                    result.data.botInfo.pictureUrl,
                    result.data.botInfo.basicId,
                    result.data.botInfo.displayName
                );
            }
    
        } catch(error) {
            throw error;
        }
    }

    /**
     * LineOfficialAccountContainerに値を設定
     * 
     * @param {string} pictureUrl  プロフィール画像のURL
     * @param {string} basicId     LINE ID
     * @param {string} displayName アカウント名
     */
    setLineOfficialAccountContainer(pictureUrl, basicId, displayName) {
        // プロフィール画像のURLを設定する
        this.setPictureUrl(pictureUrl);
        // LINE IDを設定する
        this.setBasicId(basicId);
        // アカウント名を設定する
        this.setDisplayName(displayName);
    }

    /**
     * プロフィール画像のURLを設定する
     * 
     * @param {string} pictureUrl プロフィール画像のURL
     */
    setPictureUrl(pictureUrl) {
        this.$imgOfficialAccountPictureUrl.attr('src', pictureUrl);
    }

    /**
     * LINE IDを設定する
     * 
     * @param {string} basicId LINE ID
     */
    setBasicId(basicId) {
        this.$tdLineOfficialAccountBasicId.text(basicId);
    }

    /**
     * アカウント名を設定する
     * 
     * @param {string} displayName アカウント名
     */
    setDisplayName(displayName) {
        this.$tdLineOfficialAccountDisplayName.text(displayName);
    }
}