{{--サービス提供者利用状態セレクトボックス--}}
<div class="selectBox">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        <option value="" selected>利用状態を選択</option>
        <option value="{{ \ServiceProviderUseStop::USE['value'] }}">{{ \ServiceProviderUseStop::USE['name'] }}</option>
        <option value="{{ \ServiceProviderUseStop::STOP['value'] }}">{{ \ServiceProviderUseStop::STOP['name'] }}</option>
    </select>
</div>