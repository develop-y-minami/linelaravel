/**
 * UserInputUpdateModalCallbackClass
 * 
 */
class UserInputUpdateModalCallbackClass {
    /**
     * constructor
     * 
     * @param {UserGrid} userGrid UserGridインスタンス
     * @param {number}   id       担当者情報ID
     */
    constructor(userGrid, id) {
        this.userGrid = userGrid;
        this.id = id;
    };

    /**
     * 担当者更新時コールバック
     * 
     * @param {object} user 担当者情報
     */
    updateCallback(user) {
        // 行データを取得
        let row = this.userGrid.gridApi.getRowNode(this.id);
        // 行データを更新
        row.setData(user);
    }
}

/**
 * UserDeleteConfirmModalCallbackClass
 * 
 */
class UserDeleteConfirmModalCallbackClass {
    /**
     * constructor
     * 
     * @param {UserGrid} userGrid UserGridインスタンス
     * @param {number}   id       担当者情報ID
     */
    constructor(userGrid, id) {
        this.userGrid = userGrid;
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

            // 担当者情報を削除
            let result = await UserApi.destroy(this.id);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                // 行データを取得
                let row = this.userGrid.gridApi.getRowNode(this.id);
                // 行データを削除
                this.userGrid.gridApi.applyTransaction({ remove: [row] });
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
 * UserGrid
 * 
 */
class UserGrid {
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
     * @param {number} userType          担当者種別
     * @param {number} serviceProviderId サービス提供者情報ID
     * @param {number} userAccountType   担当者アカウント種別
     * @param {string} accountId         アカウントID
     * @param {string} name              名前
     */
    init(userType = null, serviceProviderId = null, userAccountType = null, accountId = null, name = null) {
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
                    result.url = '';
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
                    result.url = '';
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
                        // 担当者入力モーダルのインスタンスを生成
                        let userInputModal = new UserInputModal(
                            new UserInputUpdateModalCallbackClass(params.context, params.data.id),
                            'modalUserInputUpdate'
                        );
                        userInputModal.init();
                        userInputModal.set(
                            params.data.id,
                            params.data.userType.id,
                            params.data.serviceProvider.id,
                            params.data.userAccountType.id,
                            params.data.accountId,
                            params.data.name,
                            params.data.email
                        );
                        userInputModal.show();
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
                        // 削除確認モーダルのインスタンスを生成
                        let userDeleteConfirmModal = new ConfirmModal(
                            new UserDeleteConfirmModalCallbackClass(params.context, params.data.id),
                            'userDeleteModalConfirm'
                        );

                        // 削除確認モーダルを表示
                        userDeleteConfirmModal.show();
                    }
                    return result;
                },
                hide: btnDeleteHide
            },
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