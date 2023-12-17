/**
 * CheckList
 * 
 */
class CheckList {
    /**
     * チェックリスト
     * 
     */
    $checkList;

    /**
     * constructor
     * 
     * @param {object} $checkList チェックリスト
     */
    constructor($checkList) {
        this.$checkList = $checkList;
    }

    /**
     * チェック件数を返却
     * 
     */
    getCheckCount() {
        let $checkBoxs = this.$checkList.find('input[type=checkbox]');

    }

    /**
     * チェックした項目の値を返却
     * 
     * @returns {array} チェック値
     */
    getCheckedValues() {
        let results = [];

        // チェックボックスを取得
        let $checkBoxs = this.$checkList.find('input[type=checkbox]');

        // チェックした項目の値を設定
        $checkBoxs.each(function() {
            if ($(this).prop('checked') === true) {
                results.push($(this).val());
            }
        });

        return results;
    }
}