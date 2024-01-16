/**
 * ServiceProviderUseStop
 * 
 */
class ServiceProviderUseStop {
    /**
     * USE
     * 
     */
    static USE = false;
    /**
     * STOP
     * 
     */
    static STOP = true;

    /**
     * 利用状態に対応する色を返却
     * 
     * @param {bool} useStop 利用状態
     */
    static getColor(useStop) {
        if (useStop == ServiceProviderUseStop.USE) {
            return 'green';
        } else {
            return 'red';
        }
    }
}