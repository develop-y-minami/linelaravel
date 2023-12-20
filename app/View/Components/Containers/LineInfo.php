<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINE情報コンテナー Component
 * 
 */
class LineInfo extends Component
{
    /**
     * __construct
     *
     * @param string id                           id属性に付与する文字列
     * @param string class                        class属性に付与する文字列
     * @param string line                         LINE情報
     * @param string array                        担当者セレクトボックス
     * @param array  lineNoticeTypeCheckListItems LINE通知種別チェックリスト選択項目
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineInfoContainer',
        public readonly string $class = '',
        public readonly ?\App\Models\Line $line = null,
        public readonly array $userSelectItems = array(),
        public readonly array $lineNoticeTypeCheckListItems = array()
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
        return view('components.containers.lineInfo');
    }
}