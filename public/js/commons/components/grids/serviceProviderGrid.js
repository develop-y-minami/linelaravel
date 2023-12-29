/**
 * ServiceProviderGrid
 * 
 */
class ServiceProviderGrid {
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
        this.grid = document.querySelector('#' + id);
        this.gridOptions = {};
    }

    /**
     * 初期化
     * 
     * @param {string}  providerId       提供者ID
     * @param {string}  name             サービス提供者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @param {boolean} useStop          サービス利用状況
     */
    init(providerId = null, name = null, useStartDateTime = null, useEndDateTime = null, useStop = null) {
        // default値を設定
        AgGrid.setDefaultGridOptions(this.gridOptions);

        // columnDefsを設定
        this.setColumnDefs();

        // 行データを初期化
        this.gridOptions.rowData = [];

        // グリッド生成
        this.gridApi = agGrid.createGrid(this.grid, this.gridOptions);

        // 行データを設定
        this.setRowData(providerId, name, useStartDateTime, useEndDateTime, useStop);
    }

    /**
     * columnDefsを設定
     * 
     */
    setColumnDefs() {
        this.gridOptions.columnDefs = [
            {
                field: 'noticeDateTime',
                headerName: '提供者ID',
                width: 240
            },
            {
                field: 'noticeDateTime',
                headerName: '提供者名',
                flex: 1
            },
            {
                field: 'noticeDateTime',
                headerName: '利用開始日',
                width: 240
            },
            {
                field: 'noticeDateTime',
                headerName: '利用終了日',
                width: 240
            },
            {
                field: 'noticeDateTime',
                headerName: '利用状態',
                width: 150
            },
        ];
    }

    /**
     * 行データを設定
     * 
     * @param {string}  providerId       提供者ID
     * @param {string}  name             サービス提供者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @param {boolean} useStop          サービス利用状況
     */
    async setRowData(providerId = null, name = null, useStartDateTime = null, useEndDateTime = null, useStop = null) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            // let result = await LineApi.notices(noticeDate, lineNoticeTypeId, displayName, userId);

            // if (result.status == FetchApi.STATUS_SUCCESS) {
            //     rowData = result.data.lineNotices;
            // }

            // 行データを設定
            this.gridApi.setRowData(rowData);

            // オーバーレイを非表示
            this.gridApi.hideOverlay();
        } catch(error) {
            throw error;
        }
    }
}