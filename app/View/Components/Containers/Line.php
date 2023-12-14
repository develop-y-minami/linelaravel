<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

/**
 * LINE情報コンテナー Component
 * 
 */
class Line extends Component
{
    /**
     * __construct
     *
     * @param string id                          id属性に付与する文字列
     * @param string class                       class属性に付与する文字列
     * @param string btnLatestLineInforId        最新情報取得ボタンのid属性
     * @param string lineAccountStatusLabelBoxId LINEアカウント状態のid属性
     * @param string imgPictureUrlId             LINEプロフィール画像のid属性
     * @param string tdDisplayNameId             LINE表示名のid属性
     * @param string tdLineAccountTypeNameId     LINEアカウント種別のid属性
     * @param string line  LINE情報
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineContainer',
        public readonly string $class = '',
        public readonly string $btnLatestLineInforId = 'btnLatestLineInfor',
        public readonly string $lineAccountStatusLabelBoxId = 'lineAccountStatusLabelBox',
        public readonly string $imgPictureUrlId = 'imgPictureUrl',
        public readonly string $tdDisplayNameId = 'tdDisplayName',
        public readonly string $tdLineAccountTypeNameId = 'tdLineAccountTypeName',
        public readonly ?\App\Models\Line $line = null,
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
        return view('components.containers.line');
    }
}