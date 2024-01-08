/**
 * LineNoticeGrid
 * 
 */
class LineNoticeGrid {
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
     * @param {string} noticeDate        通知日
     * @param {number} lineNoticeTypeId  LINE通知種別
     * @param {string} displayName       LINE表示名
     * @param {number} serviceProviderId サービス提供者ID
     * @param {number} userId            担当者ID
     */
    init(noticeDate = null, lineNoticeTypeId = null, displayName = null, serviceProviderId = null, userId = null) {
        // default値を設定
        AgGrid.setDefaultGridOptions(this.gridOptions);

        // columnDefsを設定
        this.setColumnDefs();

        // 行データを初期化
        this.gridOptions.rowData = [];

        // グリッド生成
        this.gridApi = agGrid.createGrid(this.grid, this.gridOptions);

        // 行データを設定
        this.setRowData(noticeDate, lineNoticeTypeId, displayName, serviceProviderId, userId);
    }

    /**
     * columnDefsを設定
     * 
     */
    setColumnDefs() {
        this.gridOptions.columnDefs = [
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
                    switch (Number(params.data.lineNoticeType.id)) {
                        case LineNoticeType.MESSAGE:
                        case LineNoticeType.POSTBACK:
                        case LineNoticeType.VIDEO_PLAY_COMPLETE:
                            result.labelColor = 'lightBlue';
                            break;
                        case LineNoticeType.UNSEND:
                        case LineNoticeType.UNFOLLOW:
                        case LineNoticeType.LEAVE:
                        case LineNoticeType.MEMBER_LEFT:
                            result.labelColor = 'red';
                            break;
                        case LineNoticeType.FOLLOW:
                        case LineNoticeType.JOIN:
                        case LineNoticeType.MEMBER_JOINED:
                                result.labelColor = 'green';
                                break;
                    }
                    result.labelName = params.data.lineNoticeType.displayName;
                    return result;
                }
            },
            {
                field: 'content',
                headerName: '内容',
                flex: 1
            },
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
                }
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
                }
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
    async setRowData(noticeDate = null, lineNoticeTypeId = null, displayName = null, serviceProviderId = null, userId = null) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await LineApi.notices(noticeDate, lineNoticeTypeId, displayName, serviceProviderId, userId);

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