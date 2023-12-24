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
     * LINE情報ID
     * 
     */
    lineId;

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
        this.lineId = Number($('#' + id + 'TxtLineId').val());

        // イベント設定
        this.$selLineTalkHistoryTerm.on('change', { me : this }, this.changeSelLineTalkHistoryTerm)
        this.$btnLineTalkHistory.on('click', { me : this }, this.clickBtnLineTalkHistory)
        this.$btnReload.on('click', { me : this }, this.clickBtnReload)
    }

    /**
     * 初期化処理
     * 
     */
    async init() {
        try {
            // トークコンテナーを設定
            await this.setLineTalkContainer(this, this.lineId, Number(this.$selLineTalkHistoryTerm.val()));
        } catch(error) {
            console.error(error);
        }
    }

    /**
     * トークコンテナーを設定
     * 
     * @param {class}  me                  this
     * @param {number} lineId              LINE情報ID
     * @param {number} lineTalkHistoryTerm LINEトーク履歴表示期間
     */
    async setLineTalkContainer(me, lineId, lineTalkHistoryTerm) {
        try {
            // API経由でLINEトーク履歴を取得
            let result = await LineApi.lineTalkHistorys(lineId, lineTalkHistoryTerm);

            if (result.status == FetchApi.STATUS_SUCCESS) {

            }
        } catch(error) {
            throw error;
        }
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