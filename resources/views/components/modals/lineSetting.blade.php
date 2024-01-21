{{--LINE設定モーダル--}}
<div id="{{ $id }}" class="modal modalLineSetting {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}Mode" value="{{ $mode }}">
        <input type="text" id="{{ $id }}SettingServiceProviderId" value="{{ $settingServiceProviderId }}">
        <input type="text" id="{{ $id }}SettingUserId" value="{{ $settingUserId }}">
    </div>
    <div class="container">
        <header>
            <div class="title">LINE設定</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            <div class="row">
                <div class="conditionsContainer">
                    <div class="conditions">
                        {{--サービス提供者--}}
                        @php $selServiceProviderId = $id.'SelServiceProvider' @endphp
                        <div id="{{ $id }}ServiceProviderContainer" class="inputContainer">
                            <div>サービス提供者</div>
                            <x-selects.serviceProvider :id='$selServiceProviderId' :selectItems='$serviceProviderSelectItems'></x-selects.serviceProvider>
                        </div>

                        {{--担当者--}}
                        @php $selUserId = $id.'SelUser' @endphp
                        <div id="{{ $id }}UserContainer" class="inputContainer">
                            <div>担当者</div>
                            <x-selects.user :id='$selUserId' :selectItems='$userSelectItems'></x-selects.user>
                        </div>
                    </div>
                    <button id="{{ $id }}BtnSearch" class="blue">検索</button>
                </div>
            </div>

            <div class="row gridContainer">
                <div id="{{ $id }}Grid" class="grid ag-theme-material"></div>
            </div>

            <div class="buttonContainer">
                {{--エラーメッセージ--}}
                <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>
                {{--ボタン--}}
                @if ($mode == \LineSettingMode::SETTING['value'])
                    <button id="{{ $id }}BtnSetting" class="blue">設定</button>
                @elseif ($mode == \LineSettingMode::RELEASE['value'])
                    <button id="{{ $id }}BtnRelease" class="red">解除</button>
                @endif
            </div>
        </main>
    </div>

    <div id="{{ $id }}Overlay" class="overlay">
        <div class="container">
            {{--LINE設定確認モーダル--}}
            <x-modals.confirm id="{{ $id }}LineSettingModalConfirm"></x-modals.confirm>
        </div>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>