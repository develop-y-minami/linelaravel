<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * サービス提供者登録/更新モーダル Component
 * 
 */
class ServiceProviderInput extends Component
{
    /**
     * __construct
     *
     * @param string class  class属性に付与する文字列
     * @param string lineId LINE情報ID
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalServiceProviderInput',
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
        return view('components.modals.serviceProviderInput');
    }
}