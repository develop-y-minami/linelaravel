{{--LINE担当者設定モーダル--}}
<div id="{{ $id }}" class="modal modalLineOfUserSetting {{ $class }}">
    <div class="container">
        <header>
            <div class="title">担当者設定</div>
            <button id="{{ $btnCloseId }}" class="close">×</button>
        </header>
        <main>
            <div class="lineOfUserSettingContainer">
                <div class="container">
                    {{--担当者セレクトボックス--}}
                    <x-selects.user
                        id="selLineOfUserSetting"
                        class="large"
                        blankItemName="未設定"
                        :selectItems='$userSelectItems'
                        :selectedValue='$userSelectedValue'
                    ></x-selects.user>
                </div>
                <div class="lineNoticeContainer container">
                    {{--担当者通知チェックボックス--}}
                    <div class="checkBox">
                        <input type="checkbox" id="{{ $checkLineOfUserNoticeId }}" {{ $lineOfUserNotice ? 'checked' : '' }}>
                        <label for="{{ $checkLineOfUserNoticeId }}">担当者に通知する</label>
                    </div>
                    <div class="attentionMessage">※担当者情報とLINEが連携されている必要があります</div>
                    <div id="{{ $lineNoticeTypeCheckListContainerId }}" class="lineNoticeTypeCheckListContainer">
                        {{--LINE担当者チェックリスト--}}
                        <x-lists.lineNoticeTypeCheck :checkListItems='$lineNoticeTypeCheckListItems'></x-lists.lineNoticeTypeCheck>
                    </div>
                </div>
                {{--エラーメッセージ--}}
                <div id="{{ $errorMessageId }}" class="errorMessage"></div>
                {{--設定ボタン--}}
                <div class="container">
                    <button id="{{ $btnSettingId }}" class="blue large">設定</button>
                </div>
            </div>
        </main>
    </div>

    <div id="{{ $loadingOverlayId }}" class="overlay">
        <div class="loading"></div>
    </div>
</div>