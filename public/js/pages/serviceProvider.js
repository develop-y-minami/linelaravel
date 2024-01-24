$(function() {
    /**
     * サービス提供者ID
     * 
     */
    $textServiceProviderId = $('#textServiceProviderId');
    /**
     * 提供者ID
     * 
     */
    $providerId = $('#providerId');
    /**
     * 提供者名
     * 
     */
    $name = $('#name');
    /**
     * 利用開始日
     * 
     */
    $useStartDate = $('#useStartDate');
    /**
     * 利用終了日
     * 
     */
    $useEndDate = $('#useEndDate');
    /**
     * 利用状態
     * 
     */
    $useStopFlg = $('#useStopFlg');
    /**
     * 更新日時
     * 
     */
    $updatedAt = $('#updatedAt');
    /**
     * 登録日時
     * 
     */
    $createdAt = $('#createdAt');
    /**
     * 担当者数
     * 
     */
    $userCount = $('#userCount');
    /**
     * LINE数
     * 
     */
    $lineCount = $('#lineCount');
    /**
     * 有効LINE数
     * 
     */
    $lineValidCount = $('#lineValidCount');
    /**
     * サービス提供者編集
     * 
     */
    $edit = $('#edit');
    /**
     * サービス提供者削除
     * 
     */
    $delete = $('#delete');
    /**
     * 担当者追加
     * 
     */
    $userRegister = $('#userRegister');
    /**
     * 担当者削除
     * 
     */
    $userDelete = $('#userDelete');
    /**
     * LINE設定
     * 
     */
    $lineSetting = $('#lineSetting');
    /**
     * LINE設定解除
     * 
     */
    $lineSettingRelease = $('#lineSettingRelease');
    /**
     * サービス提供者ID
     * 
     */
    serviceProviderId = Number($textServiceProviderId.val());
    /**
     * 担当者グリッド
     * 
     */
    let userGrid = new UserGrid('userGrid').create();
    /**
     * LINEグリッド
     * 
     */
    let lineGrid = new LineGrid('lineGrid').create();
    /**
     * LINEトークタイプドーナッツグラフ
     * 
     */
    let lineAccountTypeDoughnutChart = new LineAccountTypeDoughnutChart();
    /**
     * LINE状態ドーナッツグラフ
     * 
     */
    let lineAccountStatusDoughnutChart = new LineAccountStatusDoughnutChart();
    /**
     * LINEユーザードーナッツグラフ
     * 
     */
    let lineUserDoughnutChart = new LineUserDoughnutChart();
    /**
     * LINE数推移棒グラフ
     * 
     */
    let lineTransitionBarChartContainer = new DateBarChartContainer({dateBarChart : LineTransitionBarChart, dateBarChartId : 'lineTransitionBarChart'});
    /**
     * 担当者削除モーダル
     * 
     */
    let userDeleteModal = new UserDeleteModal(
        new UserDeleteModalCallbackClass(
            userDeleteModalCallback,
            {
                grid: userGrid,
                $userCount: $userCount
            }
        )
    ).init();
    /**
     * LINE設定モーダル（設定）
     * 
     */
    let lineSettingSettingModal = new LineSettingModal(
        new LineSettingModalCallbackClass(
            lineSettingModalSettingCallback,
            null,
            {
                grid: lineGrid,
                $lineCount: $lineCount,
                $lineValidCount: $lineValidCount,
                lineAccountTypeDoughnutChart: lineAccountTypeDoughnutChart,
                lineAccountStatusDoughnutChart: lineAccountStatusDoughnutChart,
                lineUserDoughnutChart: lineUserDoughnutChart
            }
        )
        ,'modalLineSettingSetting'
    ).init();
    /**
     * LINE設定モーダル（解除）
     * 
     */
    let lineSettingReleaseModal = new LineSettingModal(
        new LineSettingModalCallbackClass(
            null,
            lineSettingModalReleaseCallback,
            {
                grid: lineGrid,
                $lineCount: $lineCount,
                $lineValidCount: $lineValidCount,
                lineAccountTypeDoughnutChart: lineAccountTypeDoughnutChart,
                lineAccountStatusDoughnutChart: lineAccountStatusDoughnutChart,
                lineUserDoughnutChart: lineUserDoughnutChart
            }
        )
        ,'modalLineSettingRelease'
    ).init();

    try {
        // 初期化処理を実行
        init();
    } catch(error) {
        console.error(error);
    }

    /**
     * 初期化処理
     * 
     */
    function init() {
        try {
            // 担当者グリッドにデータを設定
            setUserGrid();

            // LINEグリッドにデータを設定
            setLineGrid();

            // グラフを描画
            lineAccountTypeDoughnutChart.setData();
            lineAccountStatusDoughnutChart.setData();
            lineUserDoughnutChart.setData();
            lineTransitionBarChartContainer.setData();

            // 担当者削除モーダルのサービス提供者IDを設定して非表示
            userDeleteModal.$selServiceProvider.val(serviceProviderId);
            userDeleteModal.$serviceProviderContainer.hide();
            
        } catch(error) {
            throw error;
        }
    }

    /**
     * 担当者グリッドを設定
     * 
     */
    async function setUserGrid() {
        // 非表示カラムを設定
        userGrid.hideColumns(['userType.name', 'serviceProvider', 'btnEdit', 'btnDelete']);

        // 行データを設定
        await userGrid.setRowData({serviceProviderId : serviceProviderId});

        // 担当者数を設定
        $userCount.html(userGrid.gridApi.getDisplayedRowCount());
    }

    async function setLineGrid() {
        // 非表示カラムを設定
        lineGrid.hideColumns(['serviceProvider']);

        // 行データを設定
        await lineGrid.setRowData({serviceProviderId : serviceProviderId});

        // LINE数を設定
        $lineCount.html(lineGrid.gridApi.getDisplayedRowCount());
        // 有効LINE数を設定
        $lineValidCount.html(lineGrid.getValidRowCount());
    }

    /**
     * サービス提供者編集
     * 
     * @param {Event} e
     */
    $edit.on('click', function(e) {
        // サービス提供者入力モーダルを起動
        new ServiceProviderInputModal(
            new ServiceProviderInputModalCallbackClass(
                null,
                serviceProviderInputModalUpdateCallback,
                {
                    $providerId: $providerId,        
                    $name: $name,
                    $useStartDate: $useStartDate,
                    $useEndDate: $useEndDate,
                    $useStopFlg: $useStopFlg,
                    $updatedAt: $updatedAt,
                    $createdAt: $createdAt
                }
            )
        ).init().set(
            serviceProviderId,
            $providerId.text(),
            $name.text(),
            $useStartDate.data('value'),
            $useEndDate.data('value'),
            $useStopFlg.data('value')
        ).show();
    });

    /**
     * サービス提供者入力モーダル更新ボタンコールバック
     * 
     * @param {object} data サービス提供者情報
     */
    function serviceProviderInputModalUpdateCallback(data) {
        this.context.$providerId.text(data.providerId);
        this.context.$name.text(data.name);
        this.context.$useStartDate.data('value', DateTimeUtil.formatDate(data.useStartDate));
        this.context.$useStartDate.text(DateTimeUtil.convertJpDate(data.useStartDate));
        this.context.$useEndDate.data('value', DateTimeUtil.formatDate(data.useEndDate));
        this.context.$useEndDate.text(DateTimeUtil.convertJpDate(data.useEndDate));
        this.context.$updatedAt.text(DateTimeUtil.convertJpDateTime(data.updatedAt));
        this.context.$createdAt.text(DateTimeUtil.convertJpDateTime(data.createdAt));

        // サービス提供者利用状態LabelBoxを再設定
        this.context.$useStopFlg.data('value', data.useStopFlg);
        this.context.$useStopFlg.text(data.useStopName);
        this.context.$useStopFlg.removeClass('red green');
        this.context.$useStopFlg.addClass(ServiceProviderUseStopFlg.getColor(data.useStopFlg));
    }

    /**
     * サービス提供者削除
     * 
     * @param {Event} e
     */
    $delete.on('click', function(e) {
        // サービス提供者削除確認モーダルを起動
        new ConfirmModal(
            new ConfirmModalCallbackClass(
                serviceProviderDeleteConfirmModalYesCallback,
                null,
                {
                    id: serviceProviderId
                }
            )
            ,'serviceProviderDeleteModalConfirm'
        ).show();
    });

    /**
     * サービス提供者削除確認モーダルYesボタンコールバック
     * 
     * @param {Event} e 
     */
    async function serviceProviderDeleteConfirmModalYesCallback(e) {
        try {
            // エラーメッセージを非表示
            this.modal.errorMessage.hide();

            // ローディングオーバレイを表示
            this.modal.$loadingOverlay.show();

            // サービス提供者情報を削除
            let result = await ServiceProviderApi.destroy(this.context.id);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // 前ページに遷移
                backPage();
            } else {
                this.modal.errorMessage.showServerError();
            }
        } catch(error) {
            console.error(error);
            // ローディングオーバレイを非表示
            this.modal.$loadingOverlay.hide();
        }
    }

    /**
     * 担当者追加
     * 
     * @param {Event} e
     */
    $userRegister.on('click', function(e) {
        let modal = new UserInputModal(
            new UserInputModalCallbackClass(
                userInputModalRegisterCallback,
                null,
                {
                    grid: userGrid,
                    $userCount: $userCount
                }
            )
        ).init();

        // 担当者種別にサービス提供者を設定し非表示
        modal.$radioUserTypeServiceProvider.prop('checked', true);
        modal.$userTypeContainer.hide();

        // サービス提供者IDを設定
        modal.$selServiceProvider.val(serviceProviderId);

        // 担当者入力モーダルを起動
        modal.show();
    });

    /**
     * 担当者入力モーダル更新ボタンコールバック
     * 
     * @param {object} data 担当者情報
     */
    function userInputModalRegisterCallback(data) {
        // グリッドにデータを追加
        this.context.grid.addRow(data);
        // 担当者数を設定
        this.context.$userCount.html(this.context.grid.gridApi.getDisplayedRowCount());
    }

    /**
     * 担当者削除クリック時
     * 
     */
    $userDelete.on('click', function(e) {
        // 担当者削除モーダルを起動
        userDeleteModal.setGrid().show();
    });

    /**
     * 担当者削除モーダル削除ボタンコールバック
     * 
     * @param {array} ids 担当者ID
     */
    function userDeleteModalCallback(ids) {
        // 行データを削除
        this.context.grid.deleteRows(ids);
        // 担当者数を設定
        this.context.$userCount.html(this.context.grid.gridApi.getDisplayedRowCount());
    }

    /**
     * LINE設定クリック時
     * 
     */
    $lineSetting.on('click', function(e) {
        // LINE設定モーダルを起動
        lineSettingSettingModal.init().setGrid().show();
    });

    /**
     * LINE設定モーダル設定ボタンコールバック
     * 
     * @param {array} datas LINE情報
     */
    function lineSettingModalSettingCallback(datas) {
        // グリッドにデータを追加
        this.context.grid.addRows(datas);
        // LINE数を設定
        this.context.$lineCount.html(this.context.grid.gridApi.getDisplayedRowCount());
        // 有効LINE数を設定
        this.context.$lineValidCount.html(this.context.grid.getValidRowCount());

        // グラフを再描画
        this.context.lineAccountTypeDoughnutChart.setData();
        this.context.lineAccountStatusDoughnutChart.setData();
        this.context.lineUserDoughnutChart.setData();
    }

    /**
     * LINE設定解除クリック時
     * 
     */
    $lineSettingRelease.on('click', function(e) {
        // LINE設定モーダルを起動
        lineSettingReleaseModal.init().setGrid().show();
    });

    /**
     * LINE設定モーダル解除ボタンコールバック
     * 
     * @param {array} ids LINE情報ID
     */
    function lineSettingModalReleaseCallback(ids) {
        // 行データを削除
        this.context.grid.deleteRows(ids);
        // LINE数を設定
        this.context.$lineCount.html(this.context.grid.gridApi.getDisplayedRowCount());
        // 有効LINE数を設定
        this.context.$lineValidCount.html(this.context.grid.getValidRowCount());

        // グラフを再描画
        this.context.lineAccountTypeDoughnutChart.setData();
        this.context.lineAccountStatusDoughnutChart.setData();
        this.context.lineUserDoughnutChart.setData();
    }
});