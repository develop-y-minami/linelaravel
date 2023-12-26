{{--LINEトーク履歴表示期間セレクトボックス--}}
<div class="selectBox">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        <option value="{{ \LineTalkHistoryTerm::MONTH['value'] }}">{{ \LineTalkHistoryTerm::MONTH['name'] }}</option>
        <option value="{{ \LineTalkHistoryTerm::WEEK['value'] }}">{{ \LineTalkHistoryTerm::WEEK['name'] }}</option>
        <option value="{{ \LineTalkHistoryTerm::DAY['value'] }}" selected>{{ \LineTalkHistoryTerm::DAY['name'] }}</option>
    </select>
</div>