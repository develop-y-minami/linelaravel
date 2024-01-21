/**
 * DoughnutChart
 * 
 */
class DoughnutChart extends MyChart {

    /**
     * constructor
     * 
     * @param {string} id ID値
     */
    constructor(id) {
        super(id);
        this.chartObj.type = 'doughnut';
    }
}