/**
 * SelectBox
 * 
 */
class SelectBox {
    /**
     * id
     * 
     */
    id;
    /**
     * エレメント
     * 
     */
    $element;

    /**
     * constructor
     * 
     * @param {string} id id
     */
    constructor(id) {
        this.id = id;
        this.$element = $('#' + id);
    }

    /**
     * 選択項目を追加
     * 
     * @param {*}       value    項目値
     * @param {string}  name     項目名
     * @param {boolean} selected チェック状態
     */
    addItem(value, name, selected = false) {
        let selectedAttr = selected == true ? 'selected' : '';
        this.$element.append('<option value="' + value + '" ' + selectedAttr + '>' + name + '</option>');
    }
}