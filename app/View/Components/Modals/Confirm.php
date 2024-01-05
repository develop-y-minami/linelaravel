<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

/**
 * 確認モーダル Component
 * 
 */
class Confirm extends Component
{
    /**
     * __construct
     *
     * @param string id         id属性に付与する文字列
     * @param string class      class属性に付与する文字列
     * @param string title      タイトル
     * @param string message    メッセージ
     * @param string btnYesName Yesボタン名
     * @param string btnNoName  Noボタン名
     * @return void
     */
    public function __construct(
        public readonly string $id = 'modalConfirm',
        public readonly string $class = '',
        public readonly string $title = '確認',
        public readonly string $message = '',
        public readonly string $btnYesName = 'はい',
        public readonly string $btnNoName = 'いいえ'
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
        return view('components.modals.confirm');
    }
}