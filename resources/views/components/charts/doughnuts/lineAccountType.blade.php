<div id="{{ $id }}Container" class="chartContainer {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}ServiceProviderId" value="{{ $serviceProviderId }}">
        <input type="text" id="{{ $id }}UserId" value="{{ $userId }}">
    </div>
    <canvas id="{{ $id }}"></canvas>
    <div id="{{ $id }}LoadingOverlay" class="overlay transparent">
        <div class="loading"></div>
    </div>
</div>