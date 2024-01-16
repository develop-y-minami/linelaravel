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
     * @param {object} data 担当者情報
     */
    callback(data) {
        if (this.callbackProc != null) {
            this.callbackProc(data);
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
        this.$btnDelete = $('#' + id + 'btnDelete');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');

        // インスタンスを生成
        this.errorMessage = new ErrorMessage(id + 'ErrorMessage');

        // イベントを設定
        this.$btnDelete.on('click', { me : this }, this.clickBtnDelete);
    }

    /**
     * モーダルを初期化
     * 
     */
    init() {
        
    }
}