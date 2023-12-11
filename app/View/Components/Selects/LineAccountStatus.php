<?php

namespace App\View\Components\Selects;

use Illuminate\View\Component;

/**
 * LINEアカウント状態セレクトボックス Component
 * 
 */
class LineAccountStatus extends Component
{
    /**
     * __construct
     *
     * @param string id               id属性に付与する文字列
     * @param string name             name属性に付与する文字列
     * @param string class            class属性に付与する文字列
     * @param array  selectItems      選択項目
     * @param string selectedValue    選択値
     * @param string blankItemValue   空項目の選択値
     * @param string blankItemName    空項目の表示名
     * @param bool   visibleBlankItem 空項目を先頭に表示する true:表示 false:表示しない
     * @return void
     */
    public function __construct(
        public readonly string $id = '',
        public readonly string $name = '',
        public readonly string $class = '',
        public readonly array $selectItems = array(),
        public readonly string $selectedValue = '0',
        public readonly string $blankItemValue = '0',
        public readonly string $blankItemName = '状態を選択',
        public readonly bool $visibleBlankItem = true
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
        return view('components.selects.select');
    }
}