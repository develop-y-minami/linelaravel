/**
 * LineGrid
 * 
 */
class LineGrid extends AgGrid {
    /**
     * constructor
     * 
     * @param {string} id ID値
     */
    constructor(id) {
        super(id);
    }

    /**
     * columnDefsを設定
     * 
     */
    setColumnDefs() {
        // サービス提供者表示/非表示
        let serviceProviderHide = false;
        if (globalUserType == UserType.SERVICE_PROVIDER) {
            serviceProviderHide = true;
        }

        // 担当者表示/非表示
        let userHide = false;
        if (globalUserType == UserType.SERVICE_PROVIDER && globalUserAccountType == UserAccountType.USER) {
            userHide = true;
        }

        // チェックボックスカラムを取得
        let columnCheckBox = this.columnCheckBox({});
        
        this.gridOptions.columnDefs = [
            columnCheckBox,
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
                },
                hide: serviceProviderHide,
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
                },
                hide: userHide,
            },
            {
                field: 'displayName',
                headerName: 'LINE',
                flex: 1,
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = '\\line\\' + params.data.id;
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
                    result.labelColor = LineAccountStatus.getColor(params.data.lineAccountStatus.id);
                    result.labelName = params.data.lineAccountStatus.name;
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
    async setRowData({lineAccountTypeId = null, lineAccountStatus = null, displayName = null, serviceProviderId = null, userId = null}) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await LineApi.lines({
                lineAccountTypeId : lineAccountTypeId,
                lineAccountStatusId : lineAccountStatus,
                displayName : displayName,
                serviceProviderId : serviceProviderId,
                userId : userId
            });

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
        let columns = [];
        columns.push('displayName');
        columns.push('lineAccountStatus');

        // サービス提供者情報の表示設定
        if (globalUserType !== UserType.SERVICE_PROVIDER) {
            columns.push('serviceProvider');
        }

        // 担当者情報の表示設定
        if (!(globalUserType == UserType.SERVICE_PROVIDER && globalUserAccountType == UserAccountType.USER)) {
            columns.push('user');
        }

        this.gridApi.setColumnsVisible(columns, true);
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

    /**
     * 有効LINE数を取得
     * 
     * @returns {number} 有効LINE数
     */
    getValidRowCount() {
        let count = 0;

        this.gridApi.forEachNode(function(node) { 
            if (LineAccountStatus.isValid(node.data.lineAccountStatus.id)) {
                count++;
            }
        });

        return count;
    }
}