/**
 * DateTimeUtil
 * 
 */
class DateTimeUtil {

    /**
     * yyyy年mm月dd日 hh時mm分ss秒に変換
     * 
     * @param {string} strDateTime 日時文字列
     * @returns {string} 変換後日時
     */
    static convertJpDateTime(strDateTime) {
        let result = '';

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

        return result;
    }
}