<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINEトーク履歴コンテナー Component
 * 
 */
class LineTalkHistory extends Component
{
    /**
     * __construct
     *
     * @param string id     id属性に付与する文字列
     * @param string class  class属性に付与する文字列
     * @param string lineId LINE情報ID
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineTalkHistoryContainer',
        public readonly string $class = '',
        public readonly string $lineId = '',
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
        return view('components.containers.lineTalkHistory');
    }
}