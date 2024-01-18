/**
 * LineNoticeType
 * 
 */
class LineNoticeType {
    /**
     * メッセージ
     * 
     */
    static MESSAGE = 1;
    /**
     * 送信取消
     * 
     */
    static UNSEND = 2;
    /**
     * 友達追加
     * 
     */
    static FOLLOW = 3;
    /**
     * ブロック
     * 
     */
    static UNFOLLOW = 4;
    /**
     * グループ参加
     * 
     */
    static JOIN = 5;
    /**
     * グループ退出
     * 
     */
    static LEAVE = 6;
    /**
     * メンバー参加
     * 
     */
    static MEMBER_JOINED = 7;
    /**
     * メンバー退出
     * 
     */
    static MEMBER_LEFT = 8;
    /**
     * ポストバック
     * 
     */
    static POSTBACK = 9;
    /**
     * 動画視聴完了
     * 
     */
    static VIDEO_PLAY_COMPLETE = 10;

    /**
     * LINE通知種別に対応する色を返却
     * 
     * @param {number} lineNoticeType LINE通知種別
     */
    static getColor(lineNoticeType) {
        switch (lineNoticeType) {
            case LineNoticeType.MESSAGE:
            case LineNoticeType.POSTBACK:
            case LineNoticeType.VIDEO_PLAY_COMPLETE:
                return 'lightBlue';
            case LineNoticeType.UNSEND:
            case LineNoticeType.UNFOLLOW:
            case LineNoticeType.LEAVE:
            case LineNoticeType.MEMBER_LEFT:
                return 'red';
            case LineNoticeType.FOLLOW:
            case LineNoticeType.JOIN:
            case LineNoticeType.MEMBER_JOINED:
                return 'green';
        }
    }
}