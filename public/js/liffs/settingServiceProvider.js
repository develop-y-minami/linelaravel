/**
 * LIFF ID
 * 
 */
const LIFF_ID = '2001775635-q8poQ0Bv';

/**
 * onload
 * 
 * @param {Event} e 
 */
window.onload = function (e) {

    /**
     * init
     * 
     */
    liff.init({liffId: LIFF_ID}).then(() => {
        // 初期化完了
        
    })
};