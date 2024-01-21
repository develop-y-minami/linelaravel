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
     * option
     * 
     */
    $options;

    /**
     * constructor
     * 
     * @param {string} id id
     */
    constructor(id) {
        this.id = id;
        this.$element = $('#' + id);

        // optionを保持
        this.$options = [];
        let childrens = this.$element.children();
        for (let i = 0; i < childrens.length; i++) {
            this.$options.push($(childrens[i]));
        }
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

    /**
     * 項目値に指定された選択項目を削除
     * 
     * @param {*} value 項目値
     */
    removeByValue(value) {
        for (let i = 0; i < this.$options.length; i++) {
            if (value == this.$options[i].val()) {
                this.$options[i].remove();
            }
        }
    }

    /**
     * 先頭項目以外を削除
     * 
     */
    removeOtherFirst() {
        for (let i = 0; i < this.$options.length; i++) {
            if (i > 0) {
                this.$options[i].remove();
            }
        }
    }
}