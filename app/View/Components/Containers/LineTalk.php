<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINEトークコンテナー Component
 * 
 */
class LineTalk extends Component
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
        public readonly string $id = 'lineTalkContainer',
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
        return view('components.containers.lineTalk');
    }
}