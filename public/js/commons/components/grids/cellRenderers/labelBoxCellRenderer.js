/**
 * LabelBoxCellRenderer
 * 
 */
class LabelBoxCellRenderer {
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
        this.eGui = document.createElement('div');
        this.eGui.classList.add('labelBox', params.labelColor);
        this.eGui.innerHTML = params.labelName;
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


}