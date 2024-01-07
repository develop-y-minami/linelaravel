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
     * @param string id     id属性に付与する文字列
     * @param string class  class属性に付与する文字列
     * @param string mode   入力モード
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalServiceProviderInput',
        public readonly string $class = '',
        public readonly int $mode = \EditMode::REGISTER
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