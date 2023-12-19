{{--LINE担当者設定モーダル--}}
<div id="{{ $id }}" class="modal modalLineOfUserSetting {{ $class }}">
    <div class="container">
        <header>
            <div class="title">担当者設定</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            <div class="lineOfUserSettingContainer">
                <div class="container">
                    {{--担当者セレクトボックス--}}
                    @php $selUserId = $id.'SelUser'; @endphp
                    <x-selects.user
                        :id='$selUserId'
                        class="large"
                        blankItemName="未設定"
                        :selectItems='$userSelectItems'
                        :selectedValue='$userSelectedValue'
                    ></x-selects.user>
                </div>
                <div class="lineNoticeContainer container">
                    {{--担当者通知チェックボックス--}}
                    <div class="checkBox">
                        <input type="checkbox" id="{{ $id }}CheckLineOfUserNotice" {{ $lineOfUserNotice ? 'checked' : '' }}>
                        <label for="{{ $id }}CheckLineOfUserNotice">担当者に通知する</label>
                    </div>
                    <div class="attentionMessage">※担当者情報とLINEが連携されている必要があります</div>
                    <div id="{{ $id }}LineNoticeTypeCheckListContainer" class="lineNoticeTypeCheckListContainer">
                        {{--LINE担当者チェックリスト--}}
                        @php $lineNoticeTypeCheckId = $id.'LineNoticeTypeCheckList'; @endphp
                        <x-lists.lineNoticeTypeCheck :id='$lineNoticeTypeCheckId' :checkListItems='$lineNoticeTypeCheckListItems'></x-lists.lineNoticeTypeCheck>
                    </div>
                </div>
                {{--エラーメッセージ--}}
                <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>
                {{--設定ボタン--}}
                <div class="container">
                    <button id="{{ $id }}BtnSetting" class="blue large">設定</button>
                </div>
            </div>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>