/**
 * LinkCellRenderer
 * 
 */
class LinkCellRenderer {
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
        this.eGui = document.createElement('a');
        this.eGui.innerHTML = params.name;
        this.eGui.setAttribute('href', params.url);
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