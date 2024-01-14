$(function() {
    /**
     * サービス提供者設定
     * 
     */
    let $serviceProviderSetting = $('#serviceProviderSetting');
    /**
     * LINE通知設定
     * 
     */
    let lineNoticeSettingCheckBoxs;
    /**
     * LINE通知担当者設定
     * 
     */
    let lineNoticeUserSettingCheckBoxs;
    /**
     * サービス提供者設定モーダル
     * 
     */
    let serviceProviderSettingModal;

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
            // LINE通知設定のインスタンスを生成
            lineNoticeSettingCheckBoxs = new CheckBoxs('checkGridLineNoticeSetting');
            // LINE通知担当者設定のインスタンスを生成
            lineNoticeUserSettingCheckBoxs = new CheckBoxs('checkGridLineNoticeUserSetting');
            // サービス提供者設定モーダルのインスタンスを生成
            serviceProviderSettingModal = new ServiceProviderSettingModal(null);
            

            // LINE通知設定チェックボックスを全て非活性に設定
            lineNoticeSettingCheckBoxs.setAllDisabled();
            // LINE通知担当者設定チェックボックスを全て非活性に設定
            lineNoticeUserSettingCheckBoxs.setAllDisabled();
        } catch(error) {
            throw error;
        }
    }

    /**
     * サービス提供者設定クリック時
     * 
     */
    $serviceProviderSetting.on('click', function(e) {
        // サービス提供者設定モーダルを起動
        serviceProviderSettingModal.init()
        serviceProviderSettingModal.show();
    });
});