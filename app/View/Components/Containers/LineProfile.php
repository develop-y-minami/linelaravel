<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;

use App\Models\LineAccountType;

/**
 * LINEプロフィール情報コンテナー Component
 * 
 */
class LineProfile extends Component
{
    /**
     * __construct
     *
     * @param string id              id属性に付与する文字列
     * @param string class           class属性に付与する文字列
     * @param string lineId          LINE情報ID
     * @param string pictureUrl      LINEプロフィール画像URL
     * @param string displayName     LINE表示名
     * @param string lineAccountType LINEアカウント種別
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineProfileContainer',
        public readonly string $class = '',
        public readonly string $lineId = '',
        public readonly ?string $pictureUrl = null,
        public readonly ?string $displayName = null,
        public readonly ?LineAccountType $lineAccountType = null
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