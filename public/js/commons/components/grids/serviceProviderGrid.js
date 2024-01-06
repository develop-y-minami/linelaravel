/**
 * ServiceProviderDeleteConfirmModalCallbackClass
 * 
 */
class ServiceProviderDeleteConfirmModalCallbackClass {
    /**
     * constructor
     * 
     * @param {ServiceProviderGrid} serviceProviderGrid ServiceProviderGridインスタンス
     * @param {number}              id                  サービス提供者情報ID
     */
    constructor(serviceProviderGrid, id) {
        this.serviceProviderGrid = serviceProviderGrid;
        this.id = id;
    };

    /**
     * Yesボタンクリック時
     * 
     * @param {Event} e
     */
    async yesCallback(e) {
        let me = e.data.me;

        try {
            // エラーメッセージを非表示
            me.errorMessage.hide();

            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

            // サービス提供者情報を削除
            let result = await ServiceProviderApi.destroy(this.id);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                // 行データを取得
                let row = this.serviceProviderGrid.gridApi.getRowNode(this.id);
                // 行データを削除
                this.serviceProviderGrid.gridApi.applyTransaction({ remove: [row] });
            } else {
                me.errorMessage.showServerError();
            }
        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            me.$loadingOverlay.hide();
        }
    }

    /**
     * Noボタンクリック時
     * 
     * @param {Event} e
     */
    noCallback(e) {
        e.data.me.close(e);
    }
}

/**
 * ServiceProviderGrid
 * 
 */
class ServiceProviderGrid {
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
     * @param {string}  providerId       サービス提供者ID
     * @param {string}  name             サービス提供者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @param {boolean} useStop          サービス利用状況
     */
    init(providerId = null, name = null, useStartDateTime = null, useEndDateTime = null, useStop = null) {
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
        this.setRowData(providerId, name, useStartDateTime, useEndDateTime, useStop);
    }

    /**
     * columnDefsを設定
     * 
     */
    setColumnDefs() {
        this.gridOptions.columnDefs = [
            {
                field: 'providerId',
                headerName: '提供者ID',
                width: 150,
                cellRenderer: LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = '';
                    result.name = params.data.providerId;
                    return result;
                }
            },
            {
                field: 'name',
                headerName: '提供者名',
                flex: 1,
                minWidth: 200,
            },
            {
                field: 'useStartDateTime',
                headerName: '利用開始日',
                width: 150,
                headerClass: 'ag-header-center',
                cellStyle: {
                    textAlign: 'center',
                },
                cellRenderer: function(params) {
                    return DateTimeUtil.convertJpDate(params.data.useStartDateTime);
                }
            },
            {
                field: 'useEndDateTime',
                headerName: '利用終了日',
                width: 150,
                headerClass: 'ag-header-center',
                cellStyle: {
                    textAlign: 'center',
                },
                cellRenderer: function(params) {
                    return DateTimeUtil.convertJpDate(params.data.useEndDateTime);
                }
            },
            {
                field: 'useStop',
                headerName: '利用状態',
                width: 150,
                headerClass : 'ag-header-center',
                cellClass : 'ag-cell-non-padding',
                cellRenderer : LabelBoxCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    if (params.data.useStop === true) {
                        result.labelColor = 'red';
                    } else {
                        result.labelColor = 'green';
                    }
                    result.labelName = params.data.useStopName;
                    return result;
                }
            },
            {
                field: 'btnEdit',
                headerName: '',
                width: 70,
                cellClass : 'ag-cell-non-padding',
                cellStyle: {
                    textAlign: 'center',
                },
                cellRenderer : ButtonCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.id = 'btnEdit' + params.data.id;
                    result.color = 'green';
                    result.name = '編集';
                    /**
                     * ボタンクリック時
                     * 
                     * @param {Event} e 
                     * @param {object} params 
                     */
                    result.clicked = function(e, params) {
                        let aa = params;
                        alert('aaaaaaaaa');
                    }
                    return result;
                },
            },
            {
                field: 'btnDelete',
                headerName: '',
                width: 70,
                cellClass : 'ag-cell-non-padding',
                cellStyle: {
                    textAlign: 'center',
                },
                cellRenderer : ButtonCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.id = 'btnDelete' + params.data.id;
                    result.color = 'red';
                    result.name = '削除';
                    /**
                     * ボタンクリック時
                     * 
                     * @param {Event} e 
                     * @param {object} params 
                     */
                    result.clicked = function(e, params) {
                        // 削除確認モーダルのインスタンスを生成
                        let serviceProviderDeleteConfirmModal = new ConfirmModal(
                            new ServiceProviderDeleteConfirmModalCallbackClass(params.context, params.data.id),
                            'serviceProviderDeleteModalConfirm'
                        );

                        // 削除確認モーダルを表示
                        serviceProviderDeleteConfirmModal.show();
                    }
                    return result;
                }
            },
        ];
    }

    /**
     * 行データを設定
     * 
     * @param {string}  providerId       サービス提供者ID
     * @param {string}  name             サービス提供者名
     * @param {string}  useStartDateTime サービス利用開始日
     * @param {string}  useEndDateTime   サービス利用終了日
     * @param {boolean} useStop          サービス利用状態
     */
    async setRowData(providerId = null, name = null, useStartDateTime = null, useEndDateTime = null, useStop = null) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await ServiceProviderApi.serviceProviders(providerId, name, useStartDateTime, useEndDateTime, useStop);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                rowData = result.data.serviceProviders;
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
}