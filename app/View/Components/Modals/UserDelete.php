<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * 担当者削除モーダル Component
 * 
 */
class UserDelete extends Component
{
    /**
     * __construct
     *
     * @param string id                         id属性に付与する文字列
     * @param string class                      class属性に付与する文字列
     * @param array  serviceProviderSelectItems サービス提供者セレクトボックス表示データ
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalUserDelete',
        public readonly string $class = '',
        public readonly array $serviceProviderSelectItems = array()
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
        return view('components.modals.userDelete');
    }
}