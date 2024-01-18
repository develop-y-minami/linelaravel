/**
 * LineNoticeGrid
 * 
 */
class LineNoticeGrid extends AgGrid {

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

        this.gridOptions.columnDefs = [
            {
                field: 'serviceProvider',
                headerName: 'サービス提供者',
                width: 150,
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = params.data.line.serviceProvider.id;
                    result.name = params.data.line.serviceProvider.name;
                    return result;
                },
                hide: serviceProviderHide,
            },
            {
                field: 'line.user.name',
                headerName: '担当者',
                width: 150,
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = params.data.line.user.id;
                    result.name = params.data.line.user.name;
                    return result;
                },
                hide: userHide,
            },
            {
                field: 'noticeDateTime',
                headerName: '通知日時',
                width: 240,
                cellRenderer: function(params) {
                    return DateTimeUtil.convertJpDateTime(params.data.noticeDateTime);
                }
            },
            {
                field: 'line',
                headerName: 'LINE',
                cellRenderer : LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = 'line\\info\\' + params.data.line.id;
                    result.name = params.data.line.displayName;
                    return result;
                }
            },
            {
                field: 'lineNoticeType.displayName',
                headerName: '通知種別',
                width: 150,
                headerClass : 'ag-header-center',
                cellClass : 'ag-cell-non-padding',
                cellRenderer : LabelBoxCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.labelColor = LineNoticeType.getColor(params.data.lineNoticeType.id);
                    result.labelName = params.data.lineNoticeType.displayName;
                    return result;
                }
            },
            {
                field: 'content',
                headerName: '内容',
                flex: 1
            },
        ];
    }

    /**
     * 行データを設定
     * 
     * @param {string} noticeDate        通知日
     * @param {number} lineNoticeTypeId  LINE通知種別
     * @param {string} displayName       LINE表示名
     * @param {number} serviceProviderId サービス提供者ID
     * @param {number} userId            担当者ID
     */
    async setRowData({noticeDate = null, lineNoticeTypeId = null, displayName = null, serviceProviderId = null, userId = null}) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await LineApi.notices({
                noticeDate : noticeDate,
                lineNoticeTypeId : lineNoticeTypeId,
                displayName : displayName,
                serviceProviderId : serviceProviderId,
                userId : userId
            });

            if (result.status == FetchApi.STATUS_SUCCESS) {
                rowData = result.data.lineNotices;
            }

            // 行データを設定
            this.gridApi.setRowData(rowData);

            // オーバーレイを非表示
            this.gridApi.hideOverlay();
        } catch(error) {
            throw error;
        }
    }
}