/**
 * CheckBoxs
 * 
 */
class CheckBoxs {
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
     * チェックボックス
     * 
     */
    $checkBoxs;

    /**
     * constructor
     * 
     * @param {string} id id
     */
    constructor(id) {
        this.id = id;
        this.$element = $('#' + id);
        this.$checkBoxs = this.$element.find('input[type="checkbox"]');
    }

    /**
     * 全チェックボックスを非活性に設定
     * 
     */
    setAllDisabled() {
        this.$checkBoxs.each(function(index, element) {
            $(this).prop('disabled', true);
        });
    }
}