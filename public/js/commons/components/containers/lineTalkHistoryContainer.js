/**
 * LineTalkHistoryContainer
 * 
 */
class LineTalkHistoryContainer {
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * 送信メッセージテキストエリア
     * 
     */
    $txtSendMessage;
    /**
     * メッセージテンプレートボタン
     * 
     */
    $btnMessageTemlate;
    /**
     * 送信ボタン
     * 
     */
    $btnSend;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
    /**
     * LINEトークコンテナー
     * 
     */
    lineTalkContainer;

    /**
     * constructor
     * 
     * @param {string} id コンテナーID
     */
    constructor(id = 'lineTalkHistoryContainer') {
        this.$container = $('#' + id);
        this.$txtSendMessage = $('#' + id + 'TxtSendMessage');
        this.$btnMessageTemlate = $('#' + id + 'BtnMessageTemlate');
        this.$btnSend = $('#' + id + 'BtnSend');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.lineTalkContainer = new LineTalkContainer();

        // イベント設定
        this.$btnSend.on('click', { me : this }, this.clickBtnSend)
    }

    /**
     * 初期化処理
     * 
     */
    async init() {
        try {
            // ローディングオーバレイを表示
            this.$loadingOverlay.show();

            // LINEトークコンテナーを初期化
            await this.lineTalkContainer.init();

        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            this.$loadingOverlay.hide();
        }
    }

    /**
     * 送信ボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnSend(e) {
        let me = e.data.me;

        try {
            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            me.$loadingOverlay.hide();
        }
    }
}