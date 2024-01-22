<div {{ $id }} class="dateBarChartContainer {{ $class }}">
    <div class="termContainer">
        <div id="{{ $id }}TermYear" class="term {{ $term == \Term::YEAR['value'] ? 'active' : '' }}" data-value="{{ \Term::YEAR['value'] }}">{{ \Term::YEAR['name'] }}</div>
        <div id="{{ $id }}TermMonth" class="term {{ $term == \Term::MONTH['value'] ? 'active' : '' }}" data-value="{{ \Term::MONTH['value'] }}">{{ \Term::MONTH['name'] }}</div>
        <div id="{{ $id }}TermDay" class="term {{ $term == \Term::DAY['value'] ? 'active' : '' }}" data-value="{{ \Term::DAY['value'] }}">{{ \Term::DAY['name'] }}</div>
        <input id="{{ $id }}TermDate" type="date" value="{{ $termDateValue }}">
        <x-buttons.reload id="{{ $id }}BtnReload"></x-buttons.reload>
    </div>
    
    {{--棒グラフ--}}
    {{ $slot }}

    <div id="{{ $id }}LoadingOverlay" class="overlay transparent">
        <div class="loading"></div>
    </div>
</div>