/**
 * DoughnutChart
 * 
 */
class DoughnutChart extends MyChart {

    /**
     * constructor
     * 
     * @param {string} id              ID値
     * @param {string} title           タイトル
     * @param {array}  labels          凡例
     * @param {array}  backgroundColor 背景色
     * @param {array}  borderColor     線色
     * @param {array}  data            データ
     */
    constructor(id, title, labels, backgroundColor, borderColor, data) {
        super(id);
        this.chartObj.type = 'doughnut';
        this.chartObj.data.labels = labels;
        this.chartObj.data.datasets = [{
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 0.5,
            data: data
        }];
        this.chartObj.options.plugins.title.text = title;
    }
}