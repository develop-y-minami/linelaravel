/**
 * UserDeleteModalCallbackClass
 * 
 */
class UserDeleteModalCallbackClass {
    /**
     * constructor
     * 
     * @param {Function} callbackProc 削除ボタンクリック時コールバック
     * @param {object}   context      context
     */
    constructor(callbackProc = null, context = null) {
        this.callbackProc = callbackProc;
        this.context = context;
    };

    /**
     * 担当者登録時コールバック
     * 
     * @param {Array} ids 担当者ID
     */
    callback(ids) {
        if (this.callbackProc != null) {
            this.callbackProc(ids);
        }
    }
}

/**
 * UserDeleteModal
 * 
 */
class UserDeleteModal extends Modal {
    /**
     * ボタンクリック時のコールバック先クラス
     * 
     */
    callbackClass;
    /**
     * サービス提供者コンテナー
     * 
     */
    $serviceProviderContainer;
    /**
     * サービス提供者セレクトボックス
     * 
     */
    $selServiceProvider;
    /**
     * 更新ボタン
     * 
     */
    $btnDelete;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
    /**
     * エラーメッセージ
     * 
     */
    errorMessage;
    /**
     * Grid
     * 
     */
    grid;

    /**
     * constructor
     * 
     * @param {class}  callbackClass ボタンクリック時のコールバック先クラス
     * @param {string} id            モーダルID
     */
    constructor(callbackClass = null, id = 'modalUserDelete') {
        super(id);
        this.callbackClass = callbackClass;
        this.$serviceProviderContainer = $('#' + id + 'ServiceProviderContainer');
        this.$selServiceProvider = $('#' + id + 'SelServiceProvider');
        this.$btnDelete = $('#' + id + 'BtnDelete');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // グリッドのインスタンスを生成
        this.grid = new UserGrid(id + 'Grid').create();

        // イベントを設定
        this.$btnDelete.on('click', { me : this }, this.clickBtnDelete);
    }

    /**
     * モーダルを初期化
     * 
     * @returns {Modal} this
     */
    init() {
        this.$selServiceProvider.val('0');

        return this;
    }

    /**
     * グリッドを設定
     * 
     * @returns {AgGrid} this
     */
    setGrid() {
        // サービス提供者IDを設定
        let serviceProviderId = null;
        if (this.$selServiceProvider.val() != '0') {
            serviceProviderId = Number(this.$selServiceProvider.val());
        }

        // グリッドに行を設定
        this.grid.visibleColumns(['checkBox']);
        this.grid.hideColumns(['userType.name', 'serviceProvider', 'btnEdit', 'btnDelete']);
        this.grid.setRowData({serviceProviderId : serviceProviderId});

        return this;
    }

    /**
     * 削除ボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnDelete(e) {
        let me = e.data.me;

        // エラーメッセージを非表示
        me.errorMessage.hide();

        // 選択行を取得
        let rows = me.grid.gridApi.getSelectedRows();

        if (rows.length === 0) {
            me.errorMessage.showNoRowSelectedError();
            return;
        }

        // 担当者IDを設定
        let ids = [];
        for (let i = 0; i < rows.length; i++) {
            ids.push(rows[i].id)
        }

        // 削除確認モーダルを表示
        new ConfirmModal(
            new ConfirmModalCallbackClass(
                me.deleteCallback,
                null,
                {
                    me: me,
                    event: e,
                    ids: ids
                }
            ),
            me.id + 'UserDeleteModalConfirm'
        ).show();
    }

    /**
     * 削除確認モーダルYesボタンコールバック
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
            let result = await UserApi.deletes(this.context.ids);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // 削除確認モーダルを閉じる
                this.modal.close(e);
                
                // 担当者削除モーダルを閉じる
                this.context.me.close(this.context.event);

                if (this.context.me.callbackClass !== null) {
                    // データを削除
                    this.context.me.grid.deleteRows(this.context.ids);
                    // コールバックを実行
                    this.context.me.callbackClass.callback(this.context.ids);
                }

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