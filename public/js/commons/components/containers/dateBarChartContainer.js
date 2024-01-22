/**
 * DateBarChartContainer
 * 
 */
class DateBarChartContainer {
    /**
     * ID値
     * 
     */
    id;
    /**
     * 単位（年）
     * 
     */
    $termYear;
    /**
     * 単位（月）
     * 
     */
    $termMonth;
    /**
     * 単位（日）
     * 
     */
    $termDay;
    /**
     * 日付
     * 
     */
    $termDate;
    /**
     * リロードボタン
     * 
     */
    $btnReload;
    /**
     * オーバーレイ
     * 
     */
    $overlay;
    /**
     * 棒グラフ
     * 
     */
    dateBarChart;

    /**
     * constructor
     * 
     * @param {string}       id           ID値
     * @param {DateBarChart} dateBarChart 棒グラフ
     */
    constructor({id = 'dateBarChartContainer', dateBarChart, dateBarChartId}) {
        this.id = id;
        this.$termYear = $('#' + id + 'TermYear');
        this.$termMonth = $('#' + id + 'TermMonth');
        this.$termDay = $('#' + id + 'TermDay');
        this.$termDate = $('#' + id + 'TermDate');
        this.$btnReload = $('#' + id + 'BtnReload');

        // 棒グラフのインスタンスを生成
        this.dateBarChart = new dateBarChart({ id : dateBarChartId, term : this.getActiveTerm(), baseDate : this.$termDate.val() });

        // オーバーレイを設定
        this.$overlay = $('#' + id + 'LoadingOverlay');

        // イベントを設定
        this.$termYear.on('click', { me : this }, this.clickTermYear);
        this.$termMonth.on('click', { me : this }, this.clickTermMonth);
        this.$termDay.on('click', { me : this }, this.clickTermDay);
        this.$btnReload.on('click', { me : this }, this.clickBtnReload);
    }

    /**
     * 選択中の単位を取得
     * 
     * @returns {number} 単位
     */
    getActiveTerm() {
        if (this.$termYear.hasClass('active')) {
            return Term.YEAR;
        } else if (this.$termMonth.hasClass('active')) {
            return Term.MONTH;
        } else if (this.$termDay.hasClass('active')) {
            return Term.DAY;
        }
    }

    /**
     * 棒グラフを描画
     * 
     */
    async setData() {
        // 単位/日付を設定
        this.dateBarChart.term = this.getActiveTerm();
        this.dateBarChart.baseDate = this.$termDate.val();

        // グラフを描画
        this.dateBarChart.setData();
    }

    /**
     * 年クリック時
     * 
     * @param {Event} e 
     */
    clickTermYear(e) {
        let me = e.data.me;

        // 単位の選択を変更
        me.$termYear.addClass('active');
        me.$termMonth.removeClass('active');
        me.$termDay.removeClass('active');

        // データを設定
        me.setData();
    }

    /**
     * 月クリック時
     * 
     * @param {Event} e 
     */
    clickTermMonth(e) {
        let me = e.data.me;

        // 単位の選択を変更
        me.$termYear.removeClass('active');
        me.$termMonth.addClass('active');
        me.$termDay.removeClass('active');

        // データを設定
        me.setData();
    }

    /**
     * 日クリック時
     * 
     * @param {Event} e 
     */
    clickTermDay(e) {
        let me = e.data.me;

        // 単位の選択を変更
        me.$termYear.removeClass('active');
        me.$termMonth.removeClass('active');
        me.$termDay.addClass('active');

        // データを設定
        me.setData();
    }

    /**
     * リロードボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnReload(e) { e.data.me.setData(); }
}