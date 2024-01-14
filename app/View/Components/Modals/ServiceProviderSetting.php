<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * サービス提供者登録/更新モーダル Component
 * 
 */
class ServiceProviderSetting extends Component
{
    /**
     * __construct
     *
     * @param string id                           id属性に付与する文字列
     * @param string class                        class属性に付与する文字列
     * @param array  serviceProviderSelectItems   サービス提供者セレクトトボックス表示データ
     * @param string serviceProviderSelectedValue サービス提供者セレクトトボックス選択値
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalServiceProviderSetting',
        public readonly string $class = '',
        public readonly array $serviceProviderSelectItems = array(),
        public readonly ?string $serviceProviderSelectedValue = '0'
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
        return view('components.modals.serviceProviderSetting');
    }
}