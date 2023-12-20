/**
 * LineInfoContainer
 * 
 */
class LineInfoContainer {
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * 担当者名
     * 
     */
    $userName;
    /**
     * 担当者設定ボタン
     * 
     */
    $btnLineOfUserSetting;
    /**
     * LINE担当者設定モーダル
     * 
     */
    lineOfUserSettingModal;
    /**
     * LINE情報コンテナー
     * 
     */
    lineContainer;
    /**
     * 担当者設定時のコールバック
     * 
     */
    lineOfUserSettingCallback;

    /**
     * constructor
     * 
     * @param {string} id コンテナーID
     */
    constructor(id = 'lineInfoContainer') {
        this.$container = $('#' + id);
        this.$userName = $('#' + id + 'UserName')
        this.$btnLineOfUserSetting = $('#' + id + 'BtnLineOfUserSetting')

        // インスタンスを生成
        this.lineOfUserSettingModal = new LineOfUserSettingModal(this);
        this.lineContainer = new LineContainer();

        // イベント設定
        this.$btnLineOfUserSetting.on('click', { me : this }, this.clickBtnLineOfUserSetting);

        /**
         * 担当者設定時のコールバック
         * 
         * @param {LineInfoContainer} me       this
         * @param {number}            userId   担当者ID
         * @param {string}            userName 担当者名
         */
        this.lineOfUserSettingCallback = function(me, userId, userName) {
            // 担当者名を設定
            if (userId === 0) {
                me.$userName.html('');
            } else {
                me.$userName.html(userName);
            }
        }
    }

    /**
     * 担当者設定ボタンクリック時
     * 
     */
    clickBtnLineOfUserSetting(e) {
        // LINE担当者設定モーダルを表示
        e.data.me.lineOfUserSettingModal.show();
    }
}