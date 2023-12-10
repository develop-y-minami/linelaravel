<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

/**
 * リロードボタン Component
 * 
 */
class Reload extends Component
{
    /**
     * __construct
     *
     * @param string id    id属性に付与する文字列
     * @param string class class属性に付与する文字列
     * @return void
     */
    public function __construct(public readonly string $id = '', public readonly string $class = '')
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.reload');
    }
}