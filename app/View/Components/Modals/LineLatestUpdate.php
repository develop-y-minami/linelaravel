<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * LINE最新情報更新モーダル Component
 * 
 */
class LineLatestUpdate extends Component
{
    /**
     * __construct
     *
     * @param string id                        id属性に付与する文字列
     * @param string class                     class属性に付与する文字列
     * @param string btnCloseId                閉じるボタンのID
     * @param string btnLineLatestUpdate       最新情報更新ボタンのID
     * @param string loadingOverlayId          ローディングオーバーレイのID
     * @param string errorMessageId            エラーメッセージのID
     * @param string lineProfileContainerId    LINEプロフィールコンテナー：id属性
     * @param string lineProfileContainerClass LINEプロフィールコンテナー：class属性
     * @param string imgPictureUrlId           LINEプロフィールコンテナー：LINEプロフィール画像のid属性
     * @param string tdDisplayNameId           LINEプロフィールコンテナー：LINE表示名のid属性
     * @param string tdLineAccountTypeNameId   LINEプロフィールコンテナー：LINEアカウント種別のid属性
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalLineLatestUpdate',
        public readonly string $class = '',
        public readonly string $btnCloseId = 'btnCloseModalLineLatestUpdate',
        public readonly string $btnLineLatestUpdate = 'btnModalLineLatestUpdate',
        public readonly string $loadingOverlayId = 'loadingOverlayModalLineLatestUpdate',
        public readonly string $errorMessageId = 'errorMessageModalLineLatestUpdate',
        public readonly string $lineProfileContainerId = 'lineProfileContainerModalLineLatestUpdate',
        public readonly string $lineProfileContainerClass = '',
        public readonly string $imgPictureUrlId = 'imgPictureUrlModalLineLatestUpdate',
        public readonly string $tdDisplayNameId = 'tdDisplayNameModalLineLatestUpdate',
        public readonly string $tdLineAccountTypeNameId = 'tdLineAccountTypeNameModalLineLatestUpdate',
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
        return view('components.modals.lineLatestUpdate');
    }
}