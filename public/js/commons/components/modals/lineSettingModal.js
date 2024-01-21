/**
 * LineSettingModalCallbackClass
 * 
 */
class LineSettingModalCallbackClass {
    /**
     * constructor
     * 
     * @param {Function} callbackProc 削除ボタンクリック時コールバック
     * @param {object}   context      context
     */
    constructor(settingCallbackProc = null, releaseCallbackProc = null, context = null) {
        this.settingCallbackProc = settingCallbackProc;
        this.releaseCallbackProc = releaseCallbackProc;
        this.context = context;
    };

    /**
     * 設定時コールバック
     * 
     * @param {Array} datas 担当者情報
     */
    settingCallback(datas) {
        if (this.settingCallbackProc != null) {
            this.settingCallbackProc(datas);
        }
    }

    /**
     * 解除時コールバック
     * 
     * @param {Array} ids 担当者ID
     */
    releaseCallback(ids) {
        if (this.releaseCallbackProc != null) {
            this.releaseCallbackProc(ids);
        }
    }
}

/**
 * LineSettingModal
 * 
 */
class LineSettingModal extends Modal {
    /**
     * ボタンクリック時のコールバック先クラス
     * 
     */
    callbackClass;
    /**
     * 表示モード
     * 
     */
    $mode;
    /**
     * 設定サービス提供者ID
     * 
     */
    $settingServiceProviderId;
    /**
     * 設定担当者ID
     * 
     */
    $settingUserId;
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
     * 担当者コンテナー
     * 
     */
    $userContainer;
    /**
     * 担当者セレクトボックス
     * 
     */
    $selUser;
    /**
     * 検索ボタン
     * 
     */
    $btnSearch;
    /**
     * 設定ボタン
     * 
     */
    $btnSetting;
    /**
     * 解除ボタン
     * 
     */
    $btnRelease;
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
     * 表示モード
     * 
     */
    mode;
    /**
     * 設定サービス提供者ID
     * 
     */
    settingServiceProviderId;
    /**
     * 設定担当者ID
     * 
     */
    settingUserId;
    /**
     * Grid
     * 
     */
    grid;
    /**
     * サービス提供者担当者連携セレクトボックス
     * 
     */
    serviceProviderUserSelectBox;

    /**
     * constructor
     * 
     * @param {class}  callbackClass ボタンクリック時のコールバック先クラス
     * @param {string} id            モーダルID
     */
    constructor(callbackClass = null, id = 'modalLineSetting') {
        super(id);
        this.callbackClass = callbackClass;
        this.$mode = $('#' + id + 'Mode');
        this.$settingServiceProviderId = $('#' + id + 'SettingServiceProviderId');
        this.$settingUserId = $('#' + id + 'SettingUserId');
        this.$serviceProviderContainer = $('#' + id + 'ServiceProviderContainer');
        this.$selServiceProvider = $('#' + id + 'SelServiceProvider');
        this.$userContainer = $('#' + id + 'UserContainer');
        this.$selUser = $('#' + id + 'SelUser');
        this.$btnSearch = $('#' + id + 'BtnSearch');
        this.$btnSetting = $('#' + id + 'BtnSetting');
        this.$btnRelease = $('#' + id + 'BtnRelease');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // グリッドのインスタンスを生成
        this.grid = new LineGrid(id + 'Grid').create();

        // サービス提供者担当者連携セレクトボックスのインスタンスを生成
        this.serviceProviderUserSelectBox = new ServiceProviderUserSelectBox(this.$selServiceProvider.attr('id'), this.$selUser.attr('id')).init();

        // 値を保持
        this.mode = Number(this.$mode.val());
        this.settingServiceProviderId = null;
        if (this.$settingServiceProviderId.val() != '0') {
            this.settingServiceProviderId = Number(this.$settingServiceProviderId.val());
        }
        this.settingUserId = null;
        if (this.$settingUserId.val() != '0') {
            this.settingUserId = Number(this.$settingUserId.val());
        }


        // イベントを設定
        
        this.$btnSearch.on('click', { me : this }, this.clickBtnSearch);
        this.$btnSetting.on('click', { me : this }, this.clickBtn);
        this.$btnRelease.on('click', { me : this }, this.clickBtn);
    }

    /**
     * モーダルを初期化
     * 
     * @returns {Modal} this
     */
    init() {
        if (LineSettingMode.SETTING === this.mode) {
            // LINE設定モード時

            this.$selServiceProvider.val('0');
            this.$selUser.val('0');

            // 設定先サービス提供者をセレクトボックスから削除
            this.serviceProviderUserSelectBox.serviceProviderSelectBox.removeByValue(this.settingServiceProviderId);

            // 担当者セレクトボックスから先頭項目以外を削除
            this.serviceProviderUserSelectBox.userSelectBox.removeOtherFirst();

            // グリッド行データ設定処理をオーバーライド
            this.grid.setRowData = this.setSettingRowData;
        } else {
            // LINE設定解除モード時

            // サービス提供者を選択
            this.$selServiceProvider.val(this.settingServiceProviderId);

            // サービス提供者の選択に対応する担当者を設定
            this.serviceProviderUserSelectBox.init();

            // サービス提供者を非表示
            this.$serviceProviderContainer.hide();

            // 担当者を選択
            if (this.settingUserId === null) {
                this.$selUser.val('0');
            } else {
                this.$selUser.val(this.settingUserId);
            }
        }

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

        // 担当者IDを設定
        let userId = null;
        if (this.$selUser.val() != '0') {
            userId = Number(this.$selUser.val());
        }

        // グリッドに行を設定
        this.grid.visibleColumns(['checkBox']);
        this.grid.hideColumns(['btnEdit', 'btnDelete']);

        if (LineSettingMode.SETTING === this.mode) {
            // LINE設定モード時
            this.grid.setRowData(this.settingServiceProviderId, this.settingUserId, serviceProviderId, userId);   
        } else {
            // LINE設定解除モード時
            this.grid.setRowData({serviceProviderId : serviceProviderId, userId : userId});
        }

        return this;
    }

    /**
     * LINE設定時行データ設定処理
     * 
     * @param {number} settingServiceProviderId 設定サービス提供者ID
     * @param {number} settingUserId            設定担当者ID
     * @param {number} serviceProviderId        サービス提供者ID
     * @param {number} userId                   担当者ID
     */
    async setSettingRowData(settingServiceProviderId, settingUserId, serviceProviderId, userId) {
        try {
            // オーバーレイを表示
            this.gridApi.showLoadingOverlay();

            // 行データ
            let rowData = [];

            // API経由で通知情報を取得
            let result = await LineApi.lines({serviceProviderId : serviceProviderId, userId : userId});

            if (result.status == FetchApi.STATUS_SUCCESS) {
                for (let i = 0; i < result.data.lines.length; i++) {
                    if (settingServiceProviderId === null || settingServiceProviderId !== result.data.lines[i].serviceProvider.id) {
                        // 同一サービス提供者IDの行データを設定しない
                        rowData.push(result.data.lines[i]);
                    } else if (settingUserId === null || settingUserId !== result.data.lines[i].user.id) {
                        // 同一担当者IDの行データを設定しない
                        rowData.push(result.data.lines[i]);
                    }
                }
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
     * 検索ボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnSearch(e) { e.data.me.setGrid(); }

    /**
     * 設定・解除ボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtn(e) {
        let me = e.data.me;

        // エラーメッセージを非表示
        me.errorMessage.hide();

        // 選択行を取得
        let rows = me.grid.gridApi.getSelectedRows();

        if (rows.length === 0) {
            me.errorMessage.showNoRowSelectedError();
            return;
        }

        // LINEIDを設定
        let ids = [];
        for (let i = 0; i < rows.length; i++) {
            ids.push(rows[i].id)
        }

        let confirmModal = '';
        if (LineSettingMode.SETTING === me.mode) {
            confirmModal = 'LINEを設定しますか？';
        } else {
            confirmModal = 'LINEを解除しますか？';
        }

        // 設定確認モーダルを表示
        new ConfirmModal(
            new ConfirmModalCallbackClass(
                me.lineSettingConfirmCallback,
                null,
                {
                    me: me,
                    event: e,
                    ids: ids
                }
            ),
            me.id + 'LineSettingModalConfirm'
        ).setMessage(confirmModal).show();
    }

    /**
     * LINE設定確認モーダルYesボタンコールバック
     * 
     * @param {Event} e 
     */
    async lineSettingConfirmCallback(e) {
        try {
            // エラーメッセージを非表示
            this.modal.errorMessage.hide();

            // ローディングオーバレイを表示
            this.modal.$loadingOverlay.show();

            // LINEを設定
            let result;
            if (this.context.me.settingUserId === null) {
                // サービス提供者を更新
                if (LineSettingMode.SETTING === this.context.me.mode) {
                    result = await LineApi.updatesServiceProvider(this.context.ids, this.context.me.settingServiceProviderId);
                } else {
                    result = await LineApi.updatesServiceProvider(this.context.ids, null);
                }
            } else {
                //result = await LineApi.setting(this.context.ids, this.context.me.settingServiceProviderId, this.context.me.settingUserId);
            }

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // LINE設定確認モーダルを閉じる
                this.modal.close(e);
                
                // LINE設定モーダルを閉じる
                this.context.me.close(this.context.event);

                if (this.context.me.callbackClass !== null) {
                    // データを削除
                    this.context.me.grid.deleteRows(this.context.ids);
                    // コールバックを実行
                    if (LineSettingMode.SETTING === this.context.me.mode) {
                        this.context.me.callbackClass.settingCallback(result.data.lines);
                    } else {
                        this.context.me.callbackClass.releaseCallback(this.context.ids);
                    }
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