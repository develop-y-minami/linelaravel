<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * LINE最新情報更新モーダル Component
 * 
 */
class LineLatestUpdate extends Component
{
    /**
     * __construct
     *
     * @param string id    id属性に付与する文字列
     * @param string class class属性に付与する文字列
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalLineLatestUpdate',
        public readonly string $class = ''
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
        return view('components.modals.lineLatestUpdate');
    }
}