/**
 * MyChart
 * 
 */
class MyChart {
    /**
     * ID
     * 
     */
    id;
    /**
     * myChart
     * 
     */
    chart;
    /**
     * object
     * 
     */
    chartObj;
    /**
     * オーバーレイ
     * 
     */
    $overlay;

    /**
     * constructor
     * 
     * @param {string} id ID値
     */
    constructor(id) {
        this.id = id;
        this.myChart = null;
        this.chartObj = {};
        this.chartObj.type = '';
        this.chartObj.data = {};
        this.chartObj.data.labels = [];
        this.chartObj.data.datasets = [];
        this.chartObj.options = {};
        this.chartObj.options.plugins = {};
        this.chartObj.options.plugins.title = {};
        this.chartObj.options.plugins.title.display = true;
        this.chartObj.options.plugins.title.text = '';

        // オーバーレイを設定
        this.$overlay = $('#' + id + 'LoadingOverlay');
    }

    /**
     * グラフを生成
     * 
     * @returns {MyChart} this
     */
    create() {
        if (this.chart) {
            // 既にグラフ生成済みの場合は破棄
            this.chart.destroy();
        }

        // グラフを生成
        this.chart = new Chart(document.getElementById(this.id), this.chartObj);

        return this;
    }
}