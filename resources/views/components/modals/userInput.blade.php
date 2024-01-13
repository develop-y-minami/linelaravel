{{--担当者入力モーダル--}}
<div id="{{ $id }}" class="modal modalUserInput {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtUserId">
    </div>
    <div class="container">
        <header>
            <div class="title">担当者情報</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--担当者種別--}}
            <div class="row" {!! \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider()) !!}>
                <x-radios.userType :id='$id' :radioItems='$userTypeRadioItems' :checkedValue="Auth::user()->user_type_id"></x-radios.userType>
            </div>

            {{--サービス提供者--}}
            @php $selServiceProviderId = $id.'SelServiceProvider' @endphp
            <div id="{{ $id }}ServiceProviderContainer" class="row hideContainer" {!! \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider()) !!}>
                <div class="required">サービス提供者</div>
                <x-selects.serviceProvider :id='$selServiceProviderId' class="large" classBox="full" :selectItems='$serviceProviderSelectItems' :selectedValue="Auth::user()->service_provider_id"></x-selects.serviceProvider>
            </div>

            {{--担当者アカウント種別--}}
            <div class="row">
                <x-radios.userAccountType :id='$id' :radioItems='$userAccountTypeRadioItems'></x-radios.userAccountType>
            </div>

            {{--アカウントID--}}
            <div class="row">
                <div class="required">アカウントID</div>
                <input type="text" id="{{ $id }}TxtAccountId" class="large" maxlength="" placeholder="※半角英数字記号で入力">
            </div>

            {{--担当者名--}}
            <div class="row">
                <div class="required">担当者名</div>
                <input type="text" id="{{ $id }}TxtName" class="large" maxlength="" placeholder="担当者名を入力">
            </div>

            {{--メールアドレス--}}
            <div class="row">
                <div>メールアドレス</div>
                <input type="text" id="{{ $id }}TxtEmail" class="large" maxlength="" placeholder="メールアドレスを入力">
            </div>

            {{--パスワード--}}
            <div class="row">
                <div class="required">パスワード</div>
                <input type="password" id="{{ $id }}TxtPassword" class="large" maxlength="" placeholder="※8文字以上で入力">
            </div>

            {{--パスワード--}}
            <div class="row">
                <div class="required">パスワード（確認入力）</div>
                <input type="password" id="{{ $id }}TxtPasswordConfirm" class="large" maxlength="" placeholder="確認入力">
            </div>
            
            {{--プロフィール画像--}}
            <div class="row">
                <div>プロフィール画像</div>
                <div class="file large">
                    <div class="container">
                        <input id="{{ $id }}TxtProfileImageName" type="text" placeholder="プロフィール画像を選択" disabled>
                        <label for="{{ $id }}FileProfileImage">
                            画像を選択
                            <input type="file" id="{{ $id }}FileProfileImage">
                        </label>
                    </div>
                    <div id="{{ $id }}ProfileImageError" class="error">aaaaaaa</div>
                </div>
            </div>

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