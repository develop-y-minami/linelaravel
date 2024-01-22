/**
 * DateBarChart
 * 
 */
class DateBarChart extends BarChart {
    /**
     * 単位
     * 
     */
    term;
    /**
     * 基点日付
     * 
     */
    baseDate;
    /**
     * 開始日
     * 
     */
    startDate;
    /**
     * 終了日
     * 
     */
    endDate;
    /**
     * 年選択時に何年前まで表示するか
     * 
     */
    YEAR_RANGE = 10;

    /**
     * constructor
     * 
     * @param {string} id              ID値
     * @param {string} title           タイトル
     * @param {array}  labels          X軸ラベル
     * @param {string} label           凡例
     * @param {array}  backgroundColor 背景色
     * @param {array}  borderColor     線色
     * @param {array}  data            データ
     */
    constructor(id, term, baseDate, title, labels, label, backgroundColor, borderColor, data) {
        super(
            id,
            title,
            labels,
            label,
            backgroundColor,
            borderColor,
            data
        );

        this.term = term;
        this.baseDate = baseDate;

        // 日付を設定
        this.setDate()

        // Labelを設定
        this.setLabel();
    }

    /**
     * 日付を設定
     * 
     */
    setDate() {
        switch (this.term) {
            case Term.YEAR :
                // YEAR_RANGEに指定した年数前の日付を取得
                let beforeYearRangeDate = DateTimeUtil.beforeYear(this.baseDate, this.YEAR_RANGE);
                // 開始日付を設定
                this.startDate = DateTimeUtil.startDate(beforeYearRangeDate);
                // 終了日付を設定
                this.endDate = DateTimeUtil.yearLastDate(this.baseDate);
                break;
            case Term.MONTH :
                // 開始日付を設定
                this.startDate = DateTimeUtil.yearStartDate(this.baseDate);
                // 終了日付を設定
                this.endDate = DateTimeUtil.yearLastDate(this.baseDate);
                break;
            case Term.DAY :
                // 開始日付を設定
                this.startDate = DateTimeUtil.startDate(this.baseDate);
                // 終了日付を設定
                this.endDate = DateTimeUtil.endDate(this.baseDate);
                break;
        }
    }

    /**
     * Labelを設定
     * 
     */
    setLabel() {
        let labels = [];

        // Dateクラスのインスタンスを生成
        let startDate = new Date(this.startDate);
        let endDate = new Date(this.endDate);

        switch (this.term) {
            case Term.YEAR :
                for (let year = startDate.getFullYear(); year <= endDate.getFullYear(); year++) {
                    labels.push(year + '年');
                }
                break;
            case Term.MONTH :
                for (let month = startDate.getMonth(); month <= endDate.getMonth(); month++) {
                    labels.push(month + 1 + '月');
                }
                break;
            case Term.DAY :
                for (let day = startDate.getDate(); day <= endDate.getDate(); day++) {
                    labels.push(day + '日');
                }
                break;
        }

        this.chartObj.data.labels = labels;
    }
}