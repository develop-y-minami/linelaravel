/**
 * UserGrid
 * 
 */
class UserGrid extends AgGrid {

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
        // 担当者種別表示/非表示
        let userTypeHide = false;
        // サービス提供者表示/非表示
        let serviceProviderHide = false;
        if (globalUserType == UserType.SERVICE_PROVIDER) {
            userTypeHide = true;
            serviceProviderHide = true;
        }

        // 編集/削除ボタン表示/非表示
        let btnEditHide = false;
        let btnDeleteHide = false;
        if (globalUserAccountType == UserAccountType.USER) {
            btnEditHide = true;
            btnDeleteHide = true;
        }

        // チェックボックスカラムを取得
        let columnCheckBox = this.columnCheckBox({});
        // 編集ボタン列
        let columnBtnEdit = this.columnBtnEdit({hide : btnEditHide});
        // 削除ボタン列
        let columnBtnDelete = this.columnBtnDelete({hide : btnDeleteHide});

        this.gridOptions.columnDefs = [
            columnCheckBox,
            {
                field: 'userType.name',
                headerName: '担当者種別',
                width: 150,
                hide: userTypeHide,
            },
            {
                field: 'serviceProvider',
                headerName: 'サービス提供者',
                width: 150,
                hide: serviceProviderHide,
                cellRenderer: LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = '\\serviceProvider\\' + params.data.serviceProvider.id;
                    result.name = params.data.serviceProvider.name;
                    return result;
                }
            },
            {
                field: 'userAccountType.name',
                headerName: 'アカウント種別',
                width: 150,
            },
            {
                field: 'accountId',
                headerName: 'アカウントID',
                width: 150,
                cellRenderer: LinkCellRenderer,
                cellRendererParams: function(params) {
                    let result = {};
                    result.url = '\\user\\' + params.data.id;
                    result.name = params.data.accountId;
                    return result;
                }
            },
            {
                field: 'name',
                headerName: '担当者名',
                flex: 1,
                minWidth: 150,
            },
            columnBtnEdit,
            columnBtnDelete,
            {
                field: 'detailInfo',
                headerName: '担当者情報',
                flex: 1,
                cellClass : 'ag-cell-non-padding',
                cellRenderer : UserCellRenderer,
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
        ]
    }

    /**
     * 行データを設定
     * 
     * @param {number} userType          担当者種別
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountType   担当者アカウント種別
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     * @param {Deferred}
     */
    async setRowData({userType = null, serviceProviderId = null, userAccountType = null, accountId = null, name = null}) {
        try {
            let deferred = new $.Deferred();

            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await UserApi.users({
                userTypeId : userType,
                serviceProviderId : serviceProviderId,
                userAccountTypeId : userAccountType,
                accountId : accountId,
                name : name
            });

            if (result.status == FetchApi.STATUS_SUCCESS) {
                rowData = result.data.users;
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

        // 運用者の場合に表示
        if (globalUserType == UserType.OPERATOR) {
            columns.push('userType.name');
            columns.push('serviceProvider');
        }

        columns.push('userAccountType.name');
        columns.push('accountId');
        columns.push('name');

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
            'userType.name',
            'serviceProvider',
            'userAccountType.name',
            'accountId',
            'name',
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
        // 担当者入力モーダルを起動
        new UserInputModal(
            new UserInputModalCallbackClass(
                null,
                params.context.updateCallback,
                {
                    grid : params.context
                }
            )
            ,'modalUserInputUpdate'
        ).init().set(
            params.data.id,
            params.data.userType.id,
            params.data.serviceProvider.id,
            params.data.userAccountType.id,
            params.data.accountId,
            params.data.name,
            params.data.email
        ).show();
    }

    /**
     * 担当者入力モーダル更新時コールバック
     * 
     * @param {object} data 担当者情報
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
            'userDeleteModalConfirm'
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

            // 担当者情報を削除
            let result = await UserApi.destroy(this.context.id);

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