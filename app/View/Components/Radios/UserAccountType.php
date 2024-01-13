<?php

namespace App\View\Components\Radios;

use Illuminate\View\Component;

/**
 * 担当者アカウント種別セレクトボックス Component
 * 
 */
class UserAccountType extends Component
{
    /**
     * __construct
     *
     * @param string id           id属性に付与する文字列
     * @param string name         name属性に付与する文字列
     * @param string class        class属性に付与する文字列
     * @param string itemName     項目名
     * @param array  radioItems   選択項目
     * @param string checkedValue 選択値
     * @return void
     */
    public function __construct(
        public readonly string $id = 'check',
        public readonly string $name = 'RadioUserAccountType',
        public readonly string $class = '',
        public readonly string $itemName = 'アカウント種別',
        public readonly array $radioItems = array(),
        public readonly string $checkedValue = \UserAccountType::USER
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
        return view('components.radios.radio');
    }
}