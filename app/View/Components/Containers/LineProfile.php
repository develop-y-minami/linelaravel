<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINEプロフィール情報コンテナー Component
 * 
 */
class LineProfile extends Component
{
    /**
     * __construct
     *
     * @param string id    id属性に付与する文字列
     * @param string class class属性に付与する文字列
     * @param string line  LINE情報
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineProfileContainer',
        public readonly string $class = '',
        public readonly ?\App\Models\Line $line = null
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
        return view('components.containers.lineProfile');
    }
}