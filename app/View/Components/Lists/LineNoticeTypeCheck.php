<?php

namespace App\View\Components\Lists;

use Illuminate\View\Component;

/**
 * LINE通知種別チェックリスト Component
 * 
 */
class LineNoticeTypeCheck extends Component
{
    /**
     * __construct
     *
     * @param string id             id属性に付与する文字列
     * @param string class          class属性に付与する文字列
     * @param string checkListItems チェックリスト項目
     * @return void
     */
    public function __construct(
        public readonly string $id = 'checkListLineNoticeType',
        public readonly string $class = '',
        public readonly array $checkListItems = array()
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
        return view('components.lists.checkList');
    }
}