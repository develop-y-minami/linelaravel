/**
 * AgGrid
 * 
 */
class AgGrid {

    /**
     * gridOptionsのdefault値を設定
     * 
     * @param {object} gridOptions 
     */
    static setDefaultGridOptions(gridOptions) {
        gridOptions.headerHeight = 33;
        gridOptions.rowHeight = 33;
        gridOptions.pagination = true;
        gridOptions.paginationPageSize = 100;
        gridOptions.animateRows = true
        gridOptions.enableCellChangeFlash = true
        gridOptions.overlayLoadingTemplate = '<div style="position:absolute;top:0;left:0;right:0; bottom:0; background: url(https://ag-grid.com/images/ag-grid-loading-spinner.svg) center no-repeat" aria-label="loading"></div>';
    }
}