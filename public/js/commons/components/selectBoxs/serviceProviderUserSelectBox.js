/**
 * ServiceProviderUserSelectBox
 * 
 */
class ServiceProviderUserSelectBox {
    /**
     * サービス提供者セレクトボックス
     * 
     */
    serviceProviderSelectBox;
    /**
     * 担当者セレクトボックス
     * 
     */
    userSelectBox;

    /**
     * constructor
     * 
     * @param {string} serviceProviderSelectBoxId サービス提供者セレクトボックスID
     * @param {string} userSelectBoxId            担当者セレクトボックスID
     */
    constructor(serviceProviderSelectBoxId = 'selServiceProvider', userSelectBoxId = 'selUser') {
        this.serviceProviderSelectBox = new SelectBox(serviceProviderSelectBoxId);
        this.userSelectBox = new SelectBox(userSelectBoxId);

        // イベントを設定
        this.serviceProviderSelectBox.$element.on('change', {me : this}, this.changeServiceProviderSelectBox);
    }

    /**
     * 初期化
     * 
     * @returns {ServiceProviderUserSelectBox} this
     */
    init() {
        // 先頭項目以外を削除
        this.userSelectBox.removeOtherFirst();

        // サービス提供者IDを取得
        let serviceProviderId = this.serviceProviderSelectBox.$element.val();
        if (serviceProviderId !== '0') {
            for (let i = 0; i < this.userSelectBox.$options.length; i++) {
                if (i > 0) {
                    // 選択項目を取得
                    let user = this.userSelectBox.$options[i];

                    if (Number(serviceProviderId) === user.data('service-provider-id')) {
                        // 同一サービス提供者の担当者を追加
                        this.userSelectBox.$element.append(user);
                    }
                }
            }
        }

        return this;
    }

    /**
     * サービス提供者セレクトボックス変更時
     * 
     * @param {Event} e 
     */
    changeServiceProviderSelectBox(e) { e.data.me.init(); }
}