<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINEプロフィール情報コンテナー Component
 * 
 */
class LineProfile extends Component
{
    /**
     * __construct
     *
     * @param string id                      id属性に付与する文字列
     * @param string class                   class属性に付与する文字列
     * @param string imgPictureUrlId         LINEプロフィール画像のid属性
     * @param string tdDisplayNameId         LINE表示名のid属性
     * @param string tdLineAccountTypeNameId LINEアカウント種別のid属性
     * @param string line  LINE情報
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineProfileContainer',
        public readonly string $class = '',
        public readonly string $imgPictureUrlId = 'imgPictureUrl',
        public readonly string $tdDisplayNameId = 'tdDisplayName',
        public readonly string $tdLineAccountTypeNameId = 'tdLineAccountTypeName',
        public readonly ?\App\Models\Line $line = null
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
        return view('components.containers.lineProfile');
    }
}