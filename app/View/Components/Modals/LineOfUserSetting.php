<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * LINE担当者設定モーダル Component
 * 
 */
class LineOfUserSetting extends Component
{
    /**
     * __construct
     *
     * @param string id                           id属性に付与する文字列
     * @param string class                        class属性に付与する文字列
     * @param array  userSelectItems              担当者セレクトボックス
     * @param int    userSelectedValue            担当者セレクトボックス選択値
     * @param array  lineNoticeTypeCheckListItems LINE通知種別チェックリスト選択項目
     * @param array  lineOfUserNotice　　　　　　  LINE通知設定
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalLineOfUserSetting',
        public readonly string $class = '',
        public readonly array $userSelectItems = array(),
        public readonly int $userSelectedValue = 0,
        public readonly array $lineNoticeTypeCheckListItems = array(),
        public readonly bool $lineOfUserNotice = false
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.lineOfUserSetting');
    }
}