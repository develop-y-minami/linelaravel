/**
 * FileUtil
 * 
 */
class FileUtil {
    /**
     * ファイル読み込み結果：OK
     * 
     */
    static READ_RESULT_STATUS_OK = 'ok';
    /**
     * ファイル読み込み結果：ERROR
     * 
     */
    static READ_RESULT_STATUS_ERROR = 'error';
    /**
     * ファイル読み込み失敗時メッセージ
     * 
     */
    static READ_ERROR_MESSAGE = 'ファイルの読み込みに失敗しました';

    /**
     * ファイルをbase64データに変換し返却
     * 
     * @param {object} file ファイル
     * @returns {Promise}
     */
    static async readAsDataURL(file) {
        // Deferred
        let deferred = new $.Deferred();

        // 返却用オブジェクト
        let result = {};

        try {
            // FileReaderのインスタンスを生成
            let fileReader = new FileReader();

            /**
             * ファイル読み込み成功時
             * 
             * @param {Event} e 
             */
            fileReader.onload = function(e) {
                // base64データを設定
                result.status = FileUtil.READ_RESULT_STATUS_OK;
                result.url = fileReader.result;
                deferred.resolve(result);
            }

            /**
             * ファイル読み込み失敗時
             * 
             * @param {Event} e 
             */
            fileReader.onerror = function(e) {
                // エラーオブジェクトを設定してresolve
                deferred.resolve(FileUtil.getReadErrorObject());
            }

            // ファイル読み込み
            fileReader.readAsDataURL(file);
        } catch (error) {
            deferred.resolve(FileUtil.getReadErrorObject());
        }

        return deferred.promise();
    }

    /**
     * ファイル読み込み失敗時のエラーオブジェクトを返却
     * 
     * @returns {object} エラーオブジェクト
     */
    static getReadErrorObject() {
        let result = {};
        result.status = FileUtil.READ_RESULT_STATUS_ERROR;
        result.error = FileUtil.READ_ERROR_MESSAGE;
        return result;
    }
}