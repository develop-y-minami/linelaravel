{{--LINEトーク履歴表示期間セレクトボックス--}}
<div class="selectBox">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        <option value="{{ \LineTalkHistoryTerm::MONTH['value'] }}">{{ \LineTalkHistoryTerm::MONTH['name'] }}</option>
        <option value="{{ \LineTalkHistoryTerm::WEEk['value'] }}">{{ \LineTalkHistoryTerm::WEEk['name'] }}</option>
        <option value="{{ \LineTalkHistoryTerm::DAY['value'] }}" selected>{{ \LineTalkHistoryTerm::DAY['name'] }}</option>
    </select>
</div>