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
    $useStartDateTime = $('#useStartDateTime');
    /**
     * 利用終了日
     * 
     */
    $useEndDateTime = $('#useEndDateTime');
    /**
     * 利用状態
     * 
     */
    $useStop = $('#useStop');
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
     * サービス提供者ID
     * 
     */
    serviceProviderId = Number($textServiceProviderId.val());
    /**
     * 担当者グリッド
     * 
     */
    let userGrid;
    /**
     * LINEグリッド
     * 
     */
    let lineGrid;

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
            // 担当者グリッドのインスタンスを生成
            userGrid = new UserGrid('userGrid');
            // LINEグリッドのインスタンスを生成
            lineGrid = new LineGrid('lineGrid');

            // 担当者グリッドを初期化
            userGrid.init(null, serviceProviderId, null, null, null);
            userGrid.hideColumns(['userType.name', 'serviceProvider', 'btnEdit', 'btnDelete']);
            // LINEグリッドを初期化
            lineGrid.init(null, null, null, serviceProviderId, null);
            lineGrid.hideColumns(['serviceProvider']);
        } catch(error) {
            throw error;
        }
    }

    /**
     * サービス提供者編集
     * 
     * @param {Event} e
     */
    $edit.on('click', function(e) {
        // サービス提供者入力モーダルのインスタンスを生成
        let modal = new ServiceProviderInputModal(
            new ServiceProviderInputModalCallbackClass(
                null,
                serviceProviderInputModalUpdateCallback,
                {
                    $providerId: $providerId,        
                    $name: $name,
                    $useStartDateTime: $useStartDateTime,
                    $useEndDateTime: $useEndDateTime,
                    $useStop: $useStop,
                    $updatedAt: $updatedAt,
                    $createdAt: $createdAt
                }
            )
        );

        // サービス提供者入力モーダルを起動
        modal.init();
        modal.set(
            serviceProviderId,
            $providerId.text(),
            $name.text(),
            $useStartDateTime.data('value'),
            $useEndDateTime.data('value'),
            $useStop.data('value')
        );
        modal.show();
    });

    /**
     * サービス提供者入力モーダル更新ボタンコールバック
     * 
     * @param {object} data サービス提供者情報
     */
    function serviceProviderInputModalUpdateCallback(data) {
        this.context.$providerId.text(data.providerId);
        this.context.$name.text(data.name);
        this.context.$useStartDateTime.data('value', DateTimeUtil.convertDate(data.useStartDateTime));
        this.context.$useStartDateTime.text(DateTimeUtil.convertJpDate(data.useStartDateTime));
        this.context.$useEndDateTime.data('value', DateTimeUtil.convertDate(data.useEndDateTime));
        this.context.$useEndDateTime.text(DateTimeUtil.convertJpDate(data.useEndDateTime));
        this.context.$updatedAt.text(DateTimeUtil.convertJpDateTime(data.updatedAt));
        this.context.$createdAt.text(DateTimeUtil.convertJpDateTime(data.createdAt));

        // サービス提供者利用状態LabelBoxを再設定
        this.context.$useStop.data('value', data.useStop);
        this.context.$useStop.text(data.useStopName);
        this.context.$useStop.removeClass('red green');
        this.context.$useStop.addClass(ServiceProviderUseStop.getColor(data.useStop));
    }
});