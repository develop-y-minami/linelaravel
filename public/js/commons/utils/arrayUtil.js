/**
 * ArrayUtil
 * 
 */
class ArrayUtil {

    /**
     * 配列の要素を数値型に変換
     * 
     * @param {array} array 配列
     * @returns {array} 変換後配列
     */
    static toNumber(array) {
        let result = [];
        for (let i = 0; i < array.length; i++) {
            result.push(Number(array[i]));
        }
        return result;
    }
}