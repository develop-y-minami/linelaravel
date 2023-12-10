/**
 * StringUtil
 * 
 */
class StringUtil {

    /**
     * 指定文字で指定の桁数になるまで文字列を埋める
     * 
     * @param {string} value  文字
     * @param {string} char   指定文字
     * @param {number} length 桁数 
     * @return {string}
     */
    static padding(value, char, length) {
        return ( Array(length).join(char) + value ).slice( -length );
    }

    /**
     * 指定の桁数になるまで0で文字列を埋める
     * 
     * @param {string} value  文字
     * @param {number} length 桁数 
     * @return {string} 
     */
    static zeroPadding(value, length) {
        return StringUtil.padding(value, '0', length);
    }

    /**
     * 入力文字列が空白か検証し結果を返却
     * 
     * @param {string} input 入力文字列
     * @returns {boolean} true:空白,false:空白でない
     */
    static isInputBlank(input) {
        if (input === undefined || input === 'undefined') {
            return true;
        } else if (input.trim() === '') {
            return true;
        }

        return false;
    }
}