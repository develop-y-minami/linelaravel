/**
 * ButtonCellRenderer
 * 
 */
class ButtonCellRenderer {
    /**
     * eGui
     * 
     */
    eGui;

    /**
     * init
     * 
     * @param {object} params 
     */
    init(params) {
        this.params = params;

        // ボタンを内包するコンテナー
        this.eGui = document.createElement('div');
        this.eGui.classList.add('p-1', 'flex', 'center', 'w-100p', 'h-100p');

        // ボタンのHTMLを生成
        let html = '<button id="' + params.id + '" class="button ' + params.color + '">' + params.name + '</button>';

        // HTMLを設定
        this.eGui.innerHTML = html;

        // イベントを設定
        this.btnClickedHandler = this.btnClickedHandler.bind(this);
        this.eGui.addEventListener('click', this.btnClickedHandler);
    }

    /**
     * getGui
     * 
     * @returns this.eGui
     */
    getGui() {
        return this.eGui;
    }

    /**
     * refresh
     * 
     * @param {object} params 
     * @returns {boolean}
     */
    refresh(params) {
        return true;
    }

    /**
     * ボタンクリック時
     * 
     * @param {Event} e 
     */
    btnClickedHandler(e) {
        this.params.clicked(e, this.params);
    }
}