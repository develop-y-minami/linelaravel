<?php

namespace App\View\Components\Charts\Doughnuts;

use Illuminate\View\Component;

/**
 * LINEユーザー ドーナッツグラフ Component
 * 
 */
class LineUser extends Component
{
    /**
     * __construct
     *
     * @param string id                id属性に付与する文字列
     * @param string class             class属性に付与する文字列
     * @param string serviceProviderId サービス提供者ID
     * @param string userId            担当者ID
     * @return void
     */
    public function __construct(
        public readonly string $id = 'lineUserDoughnutChart',
        public readonly string $class = '',
        public readonly string $serviceProviderId = '0',
        public readonly string $userId = '0'
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
        return view('components.charts.doughnuts.lineUser');
    }
}