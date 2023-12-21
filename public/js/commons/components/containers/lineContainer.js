/**
 * LineContainer
 * 
 */
class LineContainer {
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
     * constructor
     * 
     * @param {string} id コンテナーID
     */
    constructor(id = 'lineContainer') {
        this.$container = $('#' + id);
        this.$btnLineLatestUpdate = $('#' + id + 'BtnLineLatestUpdate');
        this.$lineAccountStatusLabelBox = $('#' + id + 'LabelBox');

        // インスタンスを生成
        this.lineProfileContainer = new LineProfileContainer();
        this.lineLatestUpdateModal = new LineLatestUpdateModal();

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