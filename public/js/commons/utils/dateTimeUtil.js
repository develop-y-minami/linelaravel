/**
 * DateTimeUtil
 * 
 */
class DateTimeUtil {

    /**
     * 現在日付（yyyy-mm-dd）を取得
     * 
     * @returns {string} 現在日付
     */
    static getToday() {
        let result = '';

        // Date型に変換
        let dateTime = new Date();
        let year = dateTime.getFullYear();
        let month = dateTime.getMonth() + 1;
        let date = dateTime.getDate();

        result += year + '-';
        result += StringUtil.zeroPadding(month, 2) + '-';
        result += StringUtil.zeroPadding(date, 2);

        return result;
    }

    /**
     * yyyy-mm-ddに変換
     * 
     * @param {string} strDate 日時文字列
     * @returns {string} 変換後日時
     */
    static convertDate(strDate) {
        let result = '';

        if (strDate !== null && strDate !== '') {
            // Date型に変換
            let dateTime = new Date(strDate);
            let year = dateTime.getFullYear();
            let month = dateTime.getMonth() + 1;
            let date = dateTime.getDate();

            result += year + '-';
            result += StringUtil.zeroPadding(month, 2) + '-';
            result += StringUtil.zeroPadding(date, 2);
        }

        return result;
    }

    /**
     * yyyy年mm月dd日に変換
     * 
     * @param {string} strDate 日時文字列
     * @returns {string} 変換後日時
     */
    static convertJpDate(strDate) {
        let result = '';

        if (strDate !== null && strDate !== '') {
            // Date型に変換
            let dateTime = new Date(strDate);
            let year = dateTime.getFullYear();
            let month = dateTime.getMonth() + 1;
            let date = dateTime.getDate();

            result += year + '年';
            result += StringUtil.zeroPadding(month, 2) + '月';
            result += StringUtil.zeroPadding(date, 2) + '日';
        }

        return result;
    }

    /**
     * yyyy年mm月dd日 hh時mm分ss秒に変換
     * 
     * @param {string} strDateTime 日時文字列
     * @returns {string} 変換後日時
     */
    static convertJpDateTime(strDateTime) {
        let result = '';

        if (strDateTime !== null && strDateTime !== '') {
            // Date型に変換
            let dateTime = new Date(strDateTime);
            let year = dateTime.getFullYear();
            let month = dateTime.getMonth() + 1;
            let date = dateTime.getDate();
            let hours = dateTime.getHours();
            let minutes = dateTime.getMinutes();
            let seconds = dateTime.getSeconds();

            result += year + '年';
            result += StringUtil.zeroPadding(month, 2) + '月';
            result += StringUtil.zeroPadding(date, 2) + '日';
            result += ' ';
            result += StringUtil.zeroPadding(hours, 2) + '時';
            result += StringUtil.zeroPadding(minutes, 2) + '分';
            result += StringUtil.zeroPadding(seconds, 2) + '秒';
        }

        return result;
    }

    /**
     * hh時mm分ss秒に変換
     * 
     * @param {string} strTime 時間文字列
     * @returns {string} 変換後日時
     */
    static convertJpTime(strTime) {
        let result = '';

        if (strTime !== null && strTime !== '') {
            // Date型に変換
            let dateTime = new Date('2000-01-01 ' + strTime);
            let hours = dateTime.getHours();
            let minutes = dateTime.getMinutes();
            let seconds = dateTime.getSeconds();

            result += StringUtil.zeroPadding(hours, 2) + '時';
            result += StringUtil.zeroPadding(minutes, 2) + '分';
            result += StringUtil.zeroPadding(seconds, 2) + '秒';
        }

        return result;
    }
}