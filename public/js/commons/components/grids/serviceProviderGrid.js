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
        // 編集/削除ボタン表示/非表示
        let btnEditHide = false;
        let btnDeleteHide = false;
        if (globalUserAccountType == UserAccountType.USER) {
            btnEditHide = true;
            btnDeleteHide = true;
        }

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
                        params.context.clickBtnEdit(e, params);
                    }
                    return result;
                },
                hide: btnEditHide
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
                        params.context.clickBtnDelete(e, params);
                    }
                    return result;
                },
                hide: btnDeleteHide
            },
            {
                field: 'detailInfo',
                headerName: '提供者情報',
                flex: 1,
                cellClass : 'ag-cell-non-padding',
                cellRenderer : ServiceProviderCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.btnEditId = 'detailInfoBtnDelete' + params.data.id;
                    result.btnDeleteId = 'detailInfoBtnDelete' + params.data.id;
                    /**
                     * 編集ボタンクリック時
                     * 
                     * @param {Event} e 
                     * @param {object} params 
                     */
                    result.btnEditClicked = function(e, params) {
                        params.context.clickBtnEdit(e, params);
                    }
                    /**
                     * 削除ボタンクリック時
                     * 
                     * @param {Event} e 
                     * @param {object} params 
                     */
                    result.btnDeleteClicked = function(e, params) {
                        params.context.clickBtnDelete(e, params);
                    }
                    return result;
                },
                autoHeight: true,
                hide: true
            }
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

    /**
     * 一覧表示モードで表示
     * 
     */
    showGridMode() {
        let columns = [];
        columns.push('providerId');
        columns.push('name');
        columns.push('useStartDateTime');
        columns.push('useEndDateTime');
        columns.push('useStop');

        // 管理者の場合に表示
        if (globalUserAccountType == UserAccountType.ADMIN) {
            columns.push('btnEdit');
            columns.push('btnDelete');
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
            'providerId',
            'name',
            'useStartDateTime',
            'useEndDateTime',
            'useStop',
            'btnEdit',
            'btnDelete'
        ], false);
        this.gridApi.setColumnsVisible(['detailInfo'], true);
    }

    /**
     * 編集ボタンクリック時
     * 
     * @param {Event} e 
     * @param {object} params 
     */
    clickBtnEdit(e, params) {
        // サービス提供者入力モーダルのインスタンスを生成
        let modal = new ServiceProviderInputModal(
            new ServiceProviderInputModalCallbackClass(
                null,
                params.context.updateCallback,
                {
                    grid : params.context
                }
            )
            ,'modalServiceProviderInputUpdate'
        );

        // サービス提供者入力モーダルを起動
        modal.init();
        modal.set(
            params.data.id,
            params.data.providerId,
            params.data.name,
            DateTimeUtil.convertDate(params.data.useStartDateTime),
            params.data.useEndDateTime,
            params.data.useStop
        );
        modal.show();
    }

    /**
     * サービス提供者入力モーダル更新時コールバック
     * 
     * @param {object} data サービス提供者情報
     */
    updateCallback(data) {
        // 行データを取得
        let row = this.context.grid.gridApi.getRowNode(data.id);
        // 行データを更新
        row.setData(data);
    }

    /**
     * 削除ボタンクリック時
     * 
     * @param {Event} e 
     * @param {object} params 
     */
    clickBtnDelete(e, params) {
        // 削除確認モーダルのインスタンスを生成
        let modal = new ConfirmModal(
            new ConfirmModalCallbackClass(
                params.context.deleteCallback,
                null,
                {
                    grid: params.context,
                    id: params.data.id
                }
            ),
            'serviceProviderDeleteModalConfirm'
        );

        // 削除確認モーダルを表示
        modal.show();
    }

    /**
     * 削除確認モーダルYesボタンクリック時コールバック
     * 
     * @param {Event} e 
     */
    async deleteCallback(e) {
        try {
            // エラーメッセージを非表示
            this.modal.errorMessage.hide();

            // ローディングオーバレイを表示
            this.modal.$loadingOverlay.show();

            // サービス提供者情報を削除
            let result = await ServiceProviderApi.destroy(this.context.id);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                this.modal.close(e);
                // 行データを取得
                let row = this.context.grid.gridApi.getRowNode(this.context.id);
                // 行データを削除
                this.context.grid.gridApi.applyTransaction({ remove: [row] });
            } else {
                this.modal.errorMessage.showServerError();
            }
        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            this.modal.$loadingOverlay.hide();
        }
    }
}