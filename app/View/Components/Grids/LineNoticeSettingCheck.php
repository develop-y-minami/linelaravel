<?php

namespace App\View\Components\Grids;

use Illuminate\View\Component;

/**
 * LINE通知設定チェックグリッド Component
 * 
 */
class LineNoticeSettingCheck extends Component
{
    /**
     * __construct
     *
     * @param string id             id属性に付与する文字列
     * @param string class          class属性に付与する文字列
     * @param string checkItems     チェック項目
     * @return void
     */
    public function __construct(
        public readonly string $id = 'checkGridLineNoticeSetting',
        public readonly string $class = '',
        public readonly array $checkItems = array()
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
        return view('components.grids.check');
    }
}