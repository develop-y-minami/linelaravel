{{--サービス提供者入力モーダル--}}
<div id="{{ $id }}" class="modal modalServiceProviderInput {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtServiceProviderId">
    </div>
    <div class="container">
        <header>
            <div class="title">サービス提供者情報</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--提供者ID--}}
            <div class="row">
                <div class="required">提供者ID</div>
                <input type="text" id="{{ $id }}TxtProviderId" class="large" maxlength="{{ \Length::SERVICE_PROVIDER_PROVIDER_ID }}" placeholder="提供者IDを入力">
            </div>

            {{--提供者名--}}
            <div class="row">
                <div class="required">提供者名</div>
                <input type="text" id="{{ $id }}TxtName" class="large" maxlength="{{ \Length::SERVICE_PROVIDER_NAME }}" placeholder="提供者名を入力">
            </div>

            {{--利用期間--}}
            <div class="row">
                <div>利用期間</div>
                <div class="inputContainer">
                    <input type="date" id="{{ $id }}TxtUseStartDate" class="large">
                    <span>～</span>
                    <input type="date" id="{{ $id }}TxtUseEndDate" class="large">
                </div>
            </div>

            @if ($mode == \EditMode::UPDATE)
                {{--利用停止状態--}}
                <div class="row">
                    <div class="checkBox">
                        <input type="checkbox" id="{{ $id }}CheckUseStopFlg">
                        <label for="{{ $id }}CheckUseStopFlg">利用停止に設定</label>
                    </div>
                </div>
            @endif

            {{--エラーメッセージ--}}
            <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>

            <div class="row">
                @if ($mode == \EditMode::REGISTER)
                    <button id="{{ $id }}BtnRegister" class="blue large">登録</button>
                @elseif ($mode == \EditMode::UPDATE)
                    <button id="{{ $id }}BtnUpdate" class="green large">更新</button>
                @endif
            </div>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>