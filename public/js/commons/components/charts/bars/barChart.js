/**
 * BarChart
 * 
 */
class BarChart extends MyChart {

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
    constructor(id, title, labels, label, backgroundColor, borderColor, data) {
        super(id);
        this.chartObj.type = 'bar';
        this.chartObj.data.labels = labels;
        this.chartObj.data.datasets = [{
            label: label,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1,
            data: data
        }];
        this.chartObj.options.plugins.title.text = title;
        this.chartObj.options.responsive = true;
        this.chartObj.options.maintainAspectRatio = false;
        this.chartObj.options.scales = {};
        this.chartObj.options.scales.x = {};
        this.chartObj.options.scales.y = {};
    }
}