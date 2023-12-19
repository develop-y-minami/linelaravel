/**
 * LineContainer
 * 
 */
class LineContainer {
    /**
     * オーバーレイ
     * 
     */
    $overlay;
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * LINEから最新情報を取得するボタン
     * 
     */
    $btnLineLatestUpdate;
    /**
     * LINEアカウント状態ラベルボックス
     * 
     */
    $lineAccountStatusLabelBox;
    /**
     * LINEプロフィールコンテナー
     * 
     */
    lineProfileContainer;
    /**
     * LINE最新情報更新モーダル
     * 
     */
    lineLatestUpdateModal;

    /**
     * 
     * @param {object} $overlay オーバーレイ
     * @param {string} id       コンテナーID
     */
    constructor($overlay, id = 'lineContainer') {
        this.$overlay = $overlay;
        this.$container = $('#' + id);
        this.$btnLineLatestUpdate = $('#' + id + 'BtnLineLatestUpdate');
        this.$lineAccountStatusLabelBox = $('#' + id + 'LabelBox');

        // LINEプロフィールコンテナーインスタンスを生成
        this.lineProfileContainer = new LineProfileContainer();

        // LINE最新情報更新モーダルインスタンスを生成
        this.lineLatestUpdateModal = new LineLatestUpdateModal($overlay);

        // イベントを設定
        this.$btnLineLatestUpdate.on('click', { me : this }, this.clickBtnLineLatestUpdate)
    }

    /**
     * LINEから最新情報を取得するボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnLineLatestUpdate(e) {
        let me = e.data.me;
        // LINE最新情報更新モーダルを起動
        me.lineLatestUpdateModal.show();
    }
}