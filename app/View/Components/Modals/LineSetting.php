<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * LINE設定モーダル Component
 * 
 */
class LineSetting extends Component
{
    /**
     * __construct
     *
     * @param string id                         id属性に付与する文字列
     * @param string class                      class属性に付与する文字列
     * @param int    mode                       表示モード
     * @param string settingServiceProviderId   設定サービス提供者ID
     * @param string settingUserId              設定担当者ID
     * @param array  serviceProviderSelectItems サービス提供者セレクトボックス表示データ
     * @param array  userSelectItems            担当者セレクトボックス表示データ
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalLineSetting',
        public readonly string $class = '',
        public readonly int $mode = \LineSettingMode::SETTING['value'],
        public readonly string $settingServiceProviderId = '0',
        public readonly string $settingUserId = '0',
        public readonly array $serviceProviderSelectItems = array(),
        public readonly array $userSelectItems = array()
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
        return view('components.modals.lineSetting');
    }
}