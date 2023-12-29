<?php

namespace App\View\Components\Selects;

use Illuminate\View\Component;

/**
 * サービス提供者利用状態セレクトボックス Component
 * 
 */
class ServiceProviderUseStop extends Component
{
    /**
     * __construct
     *
     * @param string id       id属性に付与する文字列
     * @param string name     name属性に付与する文字列
     * @param string class 　 class属性に付与する文字列
     * @param string classBox selectBoxクラスのclass属性に付与する文字列
     * @return void
     */
    public function __construct(
        public readonly string $id = 'selServiceProviderUseStop',
        public readonly string $name = '',
        public readonly string $class = '',
        public readonly string $classBox = ''
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
        return view('components.selects.serviceProviderUseStop');
    }
}