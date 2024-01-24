/**
 * ServiceProviderUseStopFlg
 * 
 * サービス提供者情報利用停止フラグ
 * 
 */
class ServiceProviderUseStopFlg {
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
     * 利用停止フラグに対応する色を返却
     * 
     * @param {bool} useStopFlg 利用停止フラグ
     */
    static getColor(useStopFlg) {
        if (useStopFlg == ServiceProviderUseStopFlg.USE) {
            return 'green';
        } else {
            return 'red';
        }
    }
}