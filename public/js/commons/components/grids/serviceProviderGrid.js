/**
 * ServiceProviderGrid
 * 
 */
class ServiceProviderGrid extends AgGrid {

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
        // 編集/削除ボタン表示/非表示
        let btnEditHide = false;
        let btnDeleteHide = false;
        if (globalUserAccountType == UserAccountType.USER) {
            btnEditHide = true;
            btnDeleteHide = true;
        }

        // 編集ボタン列
        let columnBtnEdit = this.columnBtnEdit({hide : btnEditHide});
        // 削除ボタン列
        let columnBtnDelete = this.columnBtnDelete({hide : btnDeleteHide});

        this.gridOptions.columnDefs = [
            {
                field: 'providerId',
                headerName: '提供者ID',
                width: 150,
                cellRenderer: LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = '\\serviceProvider\\' + params.data.id;
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
                    result.labelColor = ServiceProviderUseStop.getColor(params.data.useStop);
                    result.labelName = params.data.useStopName;
                    return result;
                }
            },
            columnBtnEdit,
            columnBtnDelete,
            {
                field: 'detailInfo',
                headerName: '提供者情報',
                flex: 1,
                cellClass : 'ag-cell-non-padding',
                cellRenderer : ServiceProviderCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.btnEditId = params.context.id + 'DetailInfoBtnDelete' + params.data.id;
                    result.btnDeleteId = params.context.id + 'DetailInfoBtnDelete' + params.data.id;
                    result.btnEditClicked = params.context.clickBtnEdit;
                    result.btnDeleteClicked = params.context.clickBtnDelete;
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
    async setRowData({providerId = null, name = null, useStartDateTime = null, useEndDateTime = null, useStop = null}) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await ServiceProviderApi.serviceProviders({
                providerId : providerId,
                name : name,
                useStartDateTime : useStartDateTime,
                useEndDateTime : useEndDateTime,
                useStop : useStop
            });

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
        // サービス提供者入力モーダルを起動
        new ServiceProviderInputModal(
            new ServiceProviderInputModalCallbackClass(
                null,
                params.context.updateCallback,
                {
                    grid : params.context
                }
            )
            ,'modalServiceProviderInputUpdate'
        ).init().set(
            params.data.id,
            params.data.providerId,
            params.data.name,
            DateTimeUtil.formatDate(params.data.useStartDateTime),
            params.data.useEndDateTime,
            params.data.useStop
        ).show();
    }

    /**
     * サービス提供者入力モーダル更新時コールバック
     * 
     * @param {object} data サービス提供者情報
     */
    updateCallback(data) {
        // 行データを更新
        this.context.grid.updateRow(data.id, data);
    }

    /**
     * 削除ボタンクリック時
     * 
     * @param {Event} e 
     * @param {object} params 
     */
    clickBtnDelete(e, params) {
        // 削除確認モーダルを表示
        new ConfirmModal(
            new ConfirmModalCallbackClass(
                params.context.deleteCallback,
                null,
                {
                    grid: params.context,
                    id: params.data.id
                }
            ),
            'serviceProviderDeleteModalConfirm'
        ).show();
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
                // 行データを削除
                this.context.grid.deleteRow(this.context.id);
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