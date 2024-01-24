$(function() {
    /**
     * 担当者ID
     * 
     */
    $textUserId = $('#textUserId');
    /**
     * サービス提供者
     * 
     */
    $serviceProviderId = $('#serviceProviderId');
    /**
     * サービス提供者利用状態
     * 
     */
    $useStopFlg = $('#useStopFlg');
    /**
     * 担当者種別
     * 
     */
    $userType = $('#userType');
    /**
     * アカウント種別
     * 
     */
    $userAccountType = $('#userAccountType');
    /**
     * アカウントID
     * 
     */
    $accountId = $('#accountId');
    /**
     * 担当者名
     * 
     */
    $name = $('#name');
    /**
     * メールアドレス
     * 
     */
    $email = $('#email');
    /**
     * 更新日時
     * 
     */
    $updatedAt = $('#updatedAt');
    /**
     * 更新日時
     * 
     */
    $createdAt = $('#createdAt');
    /**
     * 担当者編集
     * 
     */
    $edit = $('#edit');
    /**
     * 担当者削除
     * 
     */
    $delete = $('#delete');
    /**
     * 担当者ID
     * 
     */
    userId = Number($textUserId.val());
    /**
     * LINEグリッド
     * 
     */
    let lineGrid = new LineGrid('lineGrid').create();

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
            // LINEグリッドにデータを設定
            lineGrid.hideColumns(['serviceProvider']);
            lineGrid.setRowData({userId : userId});
        } catch(error) {
            throw error;
        }
    }

    /**
     * 担当者編集
     * 
     * @param {Event} e
     */
    $edit.on('click', function(e) {
        // 担当者入力モーダルを起動
        new UserInputModal(
            new UserInputModalCallbackClass(
                null,
                userInputModalUpdateCallback,
                {
                    $serviceProviderId : $serviceProviderId,
                    $useStopFlg : $useStopFlg,
                    $userType : $userType,
                    $userAccountType : $userAccountType,
                    $accountId : $accountId,
                    $name : $name,
                    $email : $email,
                    $updatedAt : $updatedAt,
                    $createdAt : $createdAt
                }
            )
        ).init().set(
            userId,
            $userType.data('value'),
            $serviceProviderId.data('value'),
            $userAccountType.data('value'),
            $accountId.text(),
            $name.text(),
            $email.text()
        ).show();
    });

    /**
     * 担当者入力モーダル更新ボタンコールバック
     * 
     * @param {object} data 担当者情報
     */
    function userInputModalUpdateCallback(data) {
        this.context.$userType.data('value', data.userType.id);
        this.context.$userType.text(data.userType.name);
        this.context.$userAccountType.data('value', data.userAccountType.id);
        this.context.$userAccountType.text(data.userAccountType.name);
        this.context.$accountId.text(data.accountId);
        this.context.$name.text(data.name);
        this.context.$email.text(data.email);
        this.context.$updatedAt.text(DateTimeUtil.convertJpDateTime(data.updatedAt));
        this.context.$createdAt.text(DateTimeUtil.convertJpDateTime(data.createdAt));

        // サービス提供者を設定
        this.context.$serviceProviderId.data('value', data.serviceProvider.id)
        this.context.$serviceProviderId.text(data.serviceProvider.name);
        this.context.$serviceProviderId.attr('href', '\\serviceProvider\\' + data.serviceProvider.id);
        // サービス提供者利用状態LabelBoxを再設定
        this.context.$useStopFlg.data('value', data.serviceProvider.useStopFlg);
        this.context.$useStopFlg.text(data.serviceProvider.useStopName);
        this.context.$useStopFlg.removeClass('red green');
        this.context.$useStopFlg.addClass(ServiceProviderUseStopFlg.getColor(data.serviceProvider.useStopFlg));
    }

    /**
     * 担当者削除
     * 
     * @param {Event} e
     */
    $delete.on('click', function(e) {
        // 担当者削除確認モーダルを起動
        new ConfirmModal(
            new ConfirmModalCallbackClass(
                userDeleteConfirmModalYesCallback,
                null,
                {
                    id: userId
                }
            )
            ,'userDeleteModalConfirm'
        ).show();
    });

    /**
     * 担当者削除確認モーダルYesボタンコールバック
     * 
     * @param {Event} e 
     */
    async function userDeleteConfirmModalYesCallback(e) {
        try {
            // エラーメッセージを非表示
            this.modal.errorMessage.hide();

            // ローディングオーバレイを表示
            this.modal.$loadingOverlay.show();

            // 担当者情報を削除
            let result = await UserApi.destroy(this.context.id);

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
});