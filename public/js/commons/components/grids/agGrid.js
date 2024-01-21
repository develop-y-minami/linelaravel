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
     * グリッドを作成
     * 
     * @param {AgGrid} this
     */
    create() {
        // default値を設定
        this.setDefaultGridOptions();

        // contextにthisを設定
        this.gridOptions.context = this;

        // columnDefsを設定
        this.setColumnDefs();

        // 行データを初期化
        this.gridOptions.rowData = [];

        // 行IDを設定
        this.gridOptions.getRowId = this.getRowId;

        // グリッド生成
        this.gridApi = agGrid.createGrid(this.grid, this.gridOptions);

        return this;
    }

    /**
     * 行IDを返却
     * 
     * @param {object} params 
     * @returns {number} ID
     */
    getRowId(params) { return params.data.id }

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
        this.gridOptions.suppressRowClickSelection = true;
        this.gridOptions.rowSelection = 'multiple';
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
     * 行データを追加
     * 
     * @param {array} datas 行データ
     */
    addRows(datas) {
        for (let i = 0; i < datas.length; i++) {
            this.addRow(datas[i]);
        }
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
     * 行データを削除
     * 
     * @param {array} ids id
     */
    deleteRows(ids) {
        for (let i = 0; i < ids.length; i++) {
            this.deleteRow(ids[i]);
        }
    }

    /**
     * 指定した列を表示
     * 
     * @param {array} columns カラム
     */
    visibleColumns(columns) {
        this.gridApi.setColumnsVisible(columns, true);
    }

    /**
     * 指定した列を非表示
     * 
     * @param {array} columns カラム
     */
    hideColumns(columns) {
        this.gridApi.setColumnsVisible(columns, false);
    }

    /**
     * チェックボックス列
     * 
     * @param {string}  field      列名
     * @param {string}  headerName 列表示名
     * @param {boolean} editable   編集可否
     * @param {number}  width      列幅
     * @param {boolean} hide       表示非表示
     * @returns {object} 列定義
     */
    columnCheckBox({field = 'checkBox', headerName = '', editable = true, width = 50, hide = true}) {
        return {
            field: field,
            headerName: headerName,
            cellRenderer: editable,
            cellEditor: 'agCheckboxCellEditor',
            editable: true,
            width: width,
            maxWidth: width,
            checkboxSelection: true,
            hide: hide
        };
    }

    /**
     * 編集ボタン列
     * 
     * @param {string}  field      列名
     * @param {string}  headerName 列表示名
     * @param {number}  width      列幅
     * @param {boolean} hide       表示非表示
     * @returns {object} 列定義
     */
    columnBtnEdit({field = 'btnEdit', headerName = '', width = 70, hide = true}) {
        return {
            field: field,
            headerName: headerName,
            width: width,
            cellClass : 'ag-cell-non-padding',
            cellStyle: {
                textAlign: 'center',
            },
            cellRenderer : ButtonCellRenderer,
            cellRendererParams: function(params) {
                let result = {};
                result.id = params.context.id + 'BtnEdit' + params.data.id;
                result.color = 'green';
                result.name = '編集';
                result.clicked = params.context.clickBtnEdit;
                return result;
            },
            hide: hide
        }
    }

    /**
     * 削除ボタン列
     * 
     * @param {string}  field      列名
     * @param {string}  headerName 列表示名
     * @param {number}  width      列幅
     * @param {boolean} hide       表示非表示
     * @returns {object} 列定義
     */
    columnBtnDelete({field = 'btnDelete', headerName = '', width = 70, hide = true}) {
        return {
            field: field,
            headerName: headerName,
            width: width,
            cellClass : 'ag-cell-non-padding',
            cellStyle: {
                textAlign: 'center',
            },
            cellRenderer : ButtonCellRenderer,
            cellRendererParams: function(params) {
                let result = {};
                result.id = params.context.id + 'BtnDelete' + params.data.id;
                result.color = 'red';
                result.name = '削除';
                result.clicked = params.context.clickBtnDelete;
                return result;
            },
            hide: hide
        }
    }
}