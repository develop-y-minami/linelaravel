class ErrorMessage {
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
    constructor(id) {
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