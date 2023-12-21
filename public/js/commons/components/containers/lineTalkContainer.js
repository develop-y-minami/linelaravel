/**
 * LineTalkContainer
 * 
 */
class LineTalkContainer {
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * LINEトーク履歴表示期間セレクトボックス
     * 
     */
    $selLineTalkHistoryTerm;
    /**
     * トーク履歴一覧ページへボタン
     * 
     */
    $btnLineTalkHistory;
    /**
     * リロードボタン
     * 
     */
    $btnReload;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;

    /**
     * 
     * @param {string} id コンテナーID
     */
    constructor(id = 'lineTalkContainer') {
        this.$container = $('#' + id);
        this.$selLineTalkHistoryTerm = $('#' + id + 'SelLineTalkHistoryTerm');
        this.$btnLineTalkHistory = $('#' + id + 'BtnLineTalkHistory');
        this.$btnReload = $('#' + id + 'BtnReload');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // イベント設定
        this.$selLineTalkHistoryTerm.on('change', { me : this }, this.changeSelLineTalkHistoryTerm)
        this.$btnLineTalkHistory.on('click', { me : this }, this.clickBtnLineTalkHistory)
        this.$btnReload.on('click', { me : this }, this.clickBtnReload)
    }

    async setLineTalkContainer() {

    }

    /**
     * LINEトーク履歴表示期間セレクトボックス変更時
     * 
     * @param {Event} e 
     */
    changeSelLineTalkHistoryTerm(e) {
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

    /**
     * トーク履歴一覧ページへボタンボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnLineTalkHistory(e) {
        
    }

    /**
     * リロードボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnReload(e) {
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