<?php

namespace App\View\Components\Containers;

use Illuminate\View\Component;
use Carbon\Carbon;

/**
 * 日付棒グラフコンテナー Component
 * 
 */
class DateBarChart extends Component
{
    /**
     * 日付初期値
     * 
     */
    public $termDateValue;

    /**
     * __construct
     *
     * @param string id     id属性に付与する文字列
     * @param string class  class属性に付与する文字列
     * @param string lineId LINE情報ID
     * @return void
     */
    public function __construct(
        public readonly string $id = 'dateBarChartContainer',
        public readonly string $class = '',
        public readonly int $term = \Term::DAY['value'],
        $termDateValue = ''
    )
    {
        if ($termDateValue != '')
        {
            $this->termDateValue = $termDateValue;
        }
        else
        {
            $this->termDateValue = Carbon::now()->toDateString();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.containers.dateBarChart');
    }
}