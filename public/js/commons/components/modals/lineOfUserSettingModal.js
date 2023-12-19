/**
 * LineOfUserSettingModal
 * 
 */
class LineOfUserSettingModal {
    /**
     * オーバーレイ
     * 
     */
    $overlay;
    /**
     * 送信ボタンクリック時コールバック
     * 
     */
    btnSettingCallback;
    /**
     * モーダル
     * 
     */
    $modal;
    /**
     * LINE情報ID
     * 
     */
    $txtLineId;
    /**
     * 閉じるボタン
     * 
     */
    $btnClose;
    /**
     * 担当者セレクトボックス
     * 
     */
    $selUser;
    /**
     * 通知チェックボックス
     * 
     */
    $checkLineOfUserNotice;
    /**
     * LINE通知種別チェックリストコンテナー
     * 
     */
    $lineNoticeTypeCheckListContainer;
    /**
     * 送信ボタン
     * 
     */
    $btnSetting;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
    /**
     * LINE通知種別チェックリスト
     * 
     */
    LineNoticeTypeCheckList;
    /**
     * エラーメッセージ
     * 
     */
    errorMessage;

    /**
     * constructor
     * 
     * @param {object}   $overlay           オーバーレイ
     * @param {Function} btnSettingCallback 送信ボタンクリック時コールバック
     * @param {string}   id                 モーダルID
     */
    constructor($overlay, btnSettingCallback, id = 'modalLineOfUserSetting') {
        this.$overlay = $overlay;
        this.btnSettingCallback = btnSettingCallback;
        this.$modal = $('#' + id);
        this.$txtLineId = $('#' + id + 'TxtLineId');
        this.$btnClose = $('#' + id + 'BtnClose');
        this.$selUser = $('#' + id + 'SelUser');
        this.$checkLineOfUserNotice = $('#' + id + 'CheckLineOfUserNotice');
        this.$lineNoticeTypeCheckListContainer = $('#' + id + 'LineNoticeTypeCheckListContainer');
        this.$btnSetting = $('#' + id + 'BtnSetting');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.LineNoticeTypeCheckList = new CheckList(id + 'LineNoticeTypeCheckList');
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // イベントを設定
        this.$overlay.on('click', { me : this }, this.close);
        this.$modal.on('click', this.clickModal);
        this.$btnClose.on('click', { me : this }, this.close);
        this.$checkLineOfUserNotice.on('change', { me : this }, this.changeCheckLineOfUserNotice);
        this.$btnSetting.on('click', { me : this }, this.clickBtnSetting);
    }

    /**
     * モーダルを表示
     * 
     */
    show() {
        // 通知チェックボックスの状態に応じてLINE通知種別チェックリストコンテナーの表示を変更
        if (this.$checkLineOfUserNotice.prop('checked') === true) {
            this.$lineNoticeTypeCheckListContainer.show();
        } else {
            this.$lineNoticeTypeCheckListContainer.hide();
        }

        this.$overlay.show();
        this.$modal.fadeIn();
    }

    /**
     * モーダルを閉じる
     * 
     * @param {Event} e 
     */
    close(e) {
        let me = e.data.me;
        me.errorMessage.hide();
        me.$overlay.hide();
        me.$modal.hide();
    }

    /**
     * モーダルクリック時
     * 
     * @param {Event} e 
     */
    clickModal(e) { e.stopPropagation(); }

    /**
     * 通知チェックボックス変更時
     * 
     * @param {Event} e 
     */
    changeCheckLineOfUserNotice(e) {
        let me = e.data.me;

        // 通知チェックボックスの状態に応じてLINE通知種別チェックリストコンテナーの表示を変更
        if (me.$checkLineOfUserNotice.prop('checked') === true) {
            me.$lineNoticeTypeCheckListContainer.slideDown();
        } else {
            me.$lineNoticeTypeCheckListContainer.slideUp();
        }
    }

    /**
     * 送信ボタンクリック時
     * 
     * @param {Event} e 
     */
    async clickBtnSetting(e) {
        let me = e.data.me;

        try {
            // エラーメッセージを非表示
            me.errorMessage.hide();

            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

            // パラメータを取得
            let userId = Number(me.$selUser.val());
            let noticeSetting = me.$checkLineOfUserNotice.prop('checked');
            let lineNoticeSttings = ArrayUtil.toNumber(me.LineNoticeTypeCheckList.getCheckedValues());

            // LINE担当者情報を設定
            let result = await LineApi.userSetting(Number(me.$txtLineId.val()), userId, noticeSetting, lineNoticeSttings);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // モーダルを閉じる
                me.close(e);
                // コールバックを実行
                me.btnSettingCallback(Number(me.$selUser.val()), me.$selUser.find('option:selected').text());
            } else {
                if (result.code === FetchApi.STATUS_CODE_VALIDATION_EXCEPTION) {
                    // バリデーションエラー時のメッセージを表示
                    let erros = [];
                    for (let i = 0; i < result.errors.length; i++) {
                        erros.push(result.errors[i].message);
                    }
                    me.errorMessage.showMessages(erros);
                } else {
                    me.errorMessage.showServerError();
                }
            }

        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            me.$loadingOverlay.hide();
        }
    }
}