class ErrorMessage {
    /**
     * エラーメッセージ：行未選択
     * 
     */
    static NO_ROW_SELECTED = '行が選択せれていません'
    /**
     * エラーメッセージ：サーバーエラー
     * 
     */
    static SERVER_ERROR = 'サーバーで予期せぬエラーが発生しました';
    /**
     * メッセージ
     * 
     */
    $message;

    /**
     * constructor
     * 
     * @param {string} id ID
     */
    constructor(id = 'errorMessage') {
        this.$message = $('#' + id);
    }

    /**
     * メッセージを表示
     * 
     * @param {string} message メッセージ
     */
    showMessage(message) {
        // メッセージを削除
        this.$message.empty();

        // メッセージを設定
        this.$message.html(message);

        // メッセージを表示
        this.$message.fadeIn();
    }

    /**
     * メッセージ（複数）を表示
     * 
     * @param {array} messages メッセージ配列
     */
    showMessages(messages) {
        // メッセージを削除
        this.$message.empty();

        if (messages.length === 1) {
            this.showMessage(messages[0]);
        } else {
            // メッセージを生成
            let html = '';
            html += '<ul>'
            for (let i = 0; i < messages.length; i++) {
                html += '<li>' + messages[i] + '</li>';
            }
            html += '</ul>'

            // メッセージを設定
            this.$message.append(html);

            // メッセージを表示
            this.$message.fadeIn();
        }
    }

    /**
     * 行未選択時のメッセージを表示
     * 
     */
    showNoRowSelectedError() {
        this.showMessage(ErrorMessage.NO_ROW_SELECTED);
    }

    /**
     * サーバーエラー発生時のメッセージを表示
     * 
     */
    showServerError() {
        this.showMessage(ErrorMessage.SERVER_ERROR);
    }

    /**
     * メッセージを非表示
     * 
     */
    hide() {
        this.$message.empty();
        this.$message.hide();
    }
}