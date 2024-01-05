<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * サービス提供者ユーザー登録 Component
 * 
 */
class ServiceProviderUserRegister extends Component
{
    /**
     * __construct
     *
     * @param string id         id属性に付与する文字列
     * @param string class      class属性に付与する文字列
     * @param string providerId 提供者ID
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalServiceProviderUserRegister',
        public readonly string $class = '',
        public readonly string $providerId = ''
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
        return view('components.modals.serviceProviderUserRegister');
    }
}