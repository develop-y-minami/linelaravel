/**
 * AgGrid
 * 
 */
class AgGrid {
    /**
     * id
     * 
     */
    id;
    /**
     * grid
     * 
     */
    grid;
    /**
     * gridOptions
     * 
     */
    gridOptions;
    /**
     * columnDefs
     * 
     */
    columnDefs;
    /**
     * gridApi
     * 
     */
    gridApi;

    /**
     * constructor
     * 
     * @param {string} id ID
     */
    constructor(id) {
        this.id = id;
        this.grid = document.querySelector('#' + id);
        this.gridOptions = {};
    }

    /**
     * gridOptionsのdefault値を設定
     * 
     */
    setDefaultGridOptions() {
        this.gridOptions.headerHeight = 33;
        this.gridOptions.rowHeight = 33;
        this.gridOptions.pagination = true;
        this.gridOptions.paginationPageSize = 100;
        this.gridOptions.animateRows = true
        this.gridOptions.overlayLoadingTemplate = '<div style="position:absolute;top:0;left:0;right:0; bottom:0; background: url(https://ag-grid.com/images/ag-grid-loading-spinner.svg) center no-repeat" aria-label="loading"></div>';
    }

    /**
     * 行データを追加
     * 
     * @param {object} data 行データ
     */
    addRow(data, addIndex = undefined) {
        // 行データを追加
        this.gridApi.applyTransaction({
            add: [data],
            addIndex: addIndex
          });
    }

    /**
     * 行データを更新
     * 
     * @param {*}      id   id
     * @param {object} data 行データ
     */
    updateRow(id, data) {
        // 行データを取得
        let row = this.gridApi.getRowNode(id);
        // 行データを更新
        row.setData(data);
    }

    /**
     * 行データを削除
     * 
     * @param {*} id id
     */
    deleteRow(id) {
        // 行データを取得
        let row = this.gridApi.getRowNode(id);
        // 行データを削除
        this.gridApi.applyTransaction({ remove: [row] });
    }

    /**
     * 指定した列を非表示
     * 
     * @param {array} columns カラム
     */
    hideColumns(columns) {
        this.gridApi.setColumnsVisible(columns, false);
    }
}