<?php

namespace App\Consts;

/**
 * LineNoticeType
 * 
 * LINE通知種別情報
 * 
 */
class LineNoticeType
{
    /**
     * MESSAGE
     * 
     */
    public const MESSAGE = 1;
    /**
     * UNSEND
     * 
     */
    public const UNSEND = 2;
    /**
     * FOLLOW
     * 
     */
    public const FOLLOW = 3;
    /**
     * UNFOLLOW
     * 
     */
    public const UNFOLLOW = 4;
    /**
     * JOIN
     * 
     */
    public const JOIN = 5;
    /**
     * LEAVE
     * 
     */
    public const LEAVE = 6;
    /**
     * MEMBER_JOINED
     * 
     */
    public const MEMBER_JOINED = 7;
    /**
     * MEMBER_LEFT
     * 
     */
    public const MEMBER_LEFT = 8;
    /**
     * POSTBACK
     * 
     */
    public const POSTBACK = 9;
    /**
     * VIDEO_PLAY_COMPLETE
     * 
     */
    public const VIDEO_PLAY_COMPLETE = 10;
}