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
        this.setDefaultGridOptions();

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

        this.gridOptions.columnDefs = [
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
                headerName: '担当者情報',
                flex: 1,
                cellClass : 'ag-cell-non-padding',
                cellRenderer : UserCellRenderer,
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
     */
    async setRowData(userType = null, serviceProviderId = null, userAccountType = null, accountId = null, name = null) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await UserApi.users(userType, serviceProviderId, userAccountType, accountId, name);

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
        // 担当者入力モーダルのインスタンスを生成
        let modal = new UserInputModal(
            new UserInputModalCallbackClass(
                null,
                params.context.updateCallback,
                {
                    grid : params.context
                }
            )
            ,'modalUserInputUpdate'
        );

        // 担当者入力モーダルを起動
        modal.init();
        modal.set(
            params.data.id,
            params.data.userType.id,
            params.data.serviceProvider.id,
            params.data.userAccountType.id,
            params.data.accountId,
            params.data.name,
            params.data.email
        );
        modal.show();
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
            'userDeleteModalConfirm'
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