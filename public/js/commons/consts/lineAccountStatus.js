/**
 * LineAccountStatus
 * 
 */
class LineAccountStatus {
    /**
     * FOLLOW
     * 
     */
    static FOLLOW = 1;
    /**
     * UNFOLLOW
     * 
     */
    static UNFOLLOW = 2;
    /**
     * JOIN
     * 
     */
    static JOIN = 3;
    /**
     * LEAVE
     * 
     */
    static LEAVE = 4;

    /**
     * アカウント状態に対応する色を返却
     * 
     * @param {number} lineAccountStatus LINEアカウント状態
     */
    static getColor(lineAccountStatus) {
        switch (Number(lineAccountStatus)) {
            case LineAccountStatus.FOLLOW:
            case LineAccountStatus.JOIN:
                return 'green';
            case LineAccountStatus.UNFOLLOW:
            case LineAccountStatus.LEAVE:
                return 'red';
        }
    }

    /**
     * アカウント状態が有効か判定
     * 
     * @param {number} lineAccountStatus LINEアカウント状態
     * @returns {boolean} 結果
     */
    static isValid(lineAccountStatus) {
        switch (Number(lineAccountStatus)) {
            case LineAccountStatus.FOLLOW:
            case LineAccountStatus.JOIN:
                return true;
            case LineAccountStatus.UNFOLLOW:
            case LineAccountStatus.LEAVE:
                return false;
        }
    }
}