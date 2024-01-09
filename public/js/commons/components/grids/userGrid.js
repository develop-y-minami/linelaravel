/**
 * UserGrid
 * 
 */
class UserGrid {
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
     * @param {string} id ID値
     */
    constructor(id) {
        this.id = id;
        this.grid = document.querySelector('#' + id);
        this.gridOptions = {};
    }

    /**
     * 初期化
     * 
     * @param {number} userType          担当者種別
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountType   担当者アカウント種別
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     */
    init(userType = null, serviceProviderId = null, userAccountType = null, accountId = null, name = null) {
        // default値を設定
        AgGrid.setDefaultGridOptions(this.gridOptions);

        // contextにthisを設定
        this.gridOptions.context = this;

        // columnDefsを設定
        this.setColumnDefs();

        // 行データを初期化
        this.gridOptions.rowData = [];

        // 行IDを設定
        this.gridOptions.getRowId = function(params) { return params.data.id; }

        // グリッド生成
        this.gridApi = agGrid.createGrid(this.grid, this.gridOptions);

        // 行データを設定
        this.setRowData(userType, serviceProviderId, userAccountType, accountId, name);
    }

    /**
     * columnDefsを設定
     * 
     */
    setColumnDefs() {
        this.gridOptions.columnDefs = [
            {
                field: 'accountId',
                headerName: 'アカウントID',
                width: 150,
            },
            {
                field: 'name',
                headerName: '担当者名',
                width: 150,
            },
            {
                field: 'userAccountType',
                headerName: 'アカウント種別',
                width: 150,
            },
            {
                field: 'userType',
                headerName: '担当者種別',
                width: 150,
            },
            {
                field: 'serviceProvider',
                headerName: 'サービス提供者',
                width: 150,
            },
        ]
    }
}