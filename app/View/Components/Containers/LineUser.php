<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINEユーザー情報コンテナー Component
 * 
 */
class LineUser extends Component
{
    /**
     * __construct
     *
     * @param string id               id属性に付与する文字列
     * @param string class            class属性に付与する文字列
     * @param LineUser lineUser LINEユーザー情報
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineUserContainer',
        public readonly string $class = '',
        public readonly ?\App\Models\LineUser $lineUser = null
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
        return view('components.containers.lineUser');
    }
}