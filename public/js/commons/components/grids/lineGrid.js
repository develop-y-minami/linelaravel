/**
 * LineGrid
 * 
 */
class LineGrid {
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
     * @param {number} lineAccountTypeId LINEアカウント種別ID
     * @param {number} lineAccountStatus LINEアカウント状態
     * @param {string} displayName       LINE表示名
     * @param {number} serviceProviderId サービス提供者ID
     * @param {number} userId            担当者ID
     */
    init(lineAccountTypeId = null, lineAccountStatus = null, displayName = null, serviceProviderId = null, userId = null) {
        // default値を設定
        AgGrid.setDefaultGridOptions(this.gridOptions);

        // columnDefsを設定
        this.setColumnDefs();

        // 行データを初期化
        this.gridOptions.rowData = [];

        // グリッド生成
        this.gridApi = agGrid.createGrid(this.grid, this.gridOptions);

        // 行データを設定
        this.setRowData(lineAccountTypeId, lineAccountStatus, displayName, serviceProviderId, userId);
    }

    /**
     * columnDefsを設定
     * 
     */
    setColumnDefs() {
        this.gridOptions.columnDefs = [
            {
                field: 'displayName',
                headerName: 'LINE',
                flex: 1,
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = 'info\\' + params.data.id;
                    result.name = params.data.displayName;
                    return result;
                }
            },
            {
                field: 'lineAccountStatus',
                headerName: '状態',
                width: 150,
                headerClass : 'ag-header-center',
                cellClass : 'ag-cell-non-padding',
                cellRenderer : LabelBoxCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    switch (Number(params.data.lineAccountStatus.id)) {
                        case LineAccountStatus.FOLLOW:
                        case LineAccountStatus.JOIN:
                            result.labelColor = 'green';
                            break;
                        case LineAccountStatus.UNFOLLOW:
                        case LineAccountStatus.LEAVE:
                            result.labelColor = 'red';
                                break;
                    }
                    result.labelName = params.data.lineAccountStatus.name;
                    return result;
                }
            },
            {
                field: 'serviceProvider',
                headerName: 'サービス提供者',
                width: 150,
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = params.data.serviceProvider.id;
                    result.name = params.data.serviceProvider.name;
                    return result;
                }
            },
            {
                field: 'user',
                headerName: '担当者',
                width: 150,
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = params.data.user.id;
                    result.name = params.data.user.name;
                    return result;
                }
            },
            {
                field: 'detailInfo',
                headerName: 'LINE',
                flex: 1,
                cellClass : 'ag-cell-non-padding',
                cellRenderer : LineCellRenderer,
                autoHeight: true,
                hide: true
            },
        ];
    }

    /**
     * 行データを設定
     * 
     * @param {number} lineAccountTypeId LINEアカウント種別ID
     * @param {number} lineAccountStatus LINEアカウント状態
     * @param {string} displayName       LINE表示名
     * @param {number} serviceProviderId サービス提供者ID
     * @param {number} userId            担当者ID
     */
    async setRowData(lineAccountTypeId = null, lineAccountStatus = null, displayName = null, serviceProviderId = null, userId = null) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await LineApi.lines(lineAccountTypeId, lineAccountStatus, displayName, serviceProviderId, userId);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                rowData = result.data.lines;
            }

            // 行データを設定
            this.gridApi.setRowData(rowData);

            // オーバーレイを非表示
            this.gridApi.hideOverlay();
        } catch(error) {
            throw error;
        }
    }

    /**
     * 一覧表示モードで表示
     * 
     */
    showGridMode() {
        this.gridApi.setColumnsVisible([
            'displayName',
            'lineAccountStatus',
            'serviceProvider',
            'user'
        ], true);
        this.gridApi.setColumnsVisible(['detailInfo'], false);
    }

    /**
     * 詳細表示モードで表示
     * 
     */
    showDetailInfoMode() {
        this.gridApi.setColumnsVisible([
            'displayName',
            'lineAccountStatus',
            'serviceProvider',
            'user'
        ], false);
        this.gridApi.setColumnsVisible(['detailInfo'], true);
    }
}