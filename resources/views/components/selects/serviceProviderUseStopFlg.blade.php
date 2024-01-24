{{--サービス提供者利用停止フラグセレクトボックス--}}
<div class="selectBox">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        <option value="" selected>利用状態を選択</option>
        <option value="{{ \ServiceProviderUseStopFlg::USE['value'] }}">{{ \ServiceProviderUseStopFlg::USE['name'] }}</option>
        <option value="{{ \ServiceProviderUseStopFlg::STOP['value'] }}">{{ \ServiceProviderUseStopFlg::STOP['name'] }}</option>
    </select>
</div>