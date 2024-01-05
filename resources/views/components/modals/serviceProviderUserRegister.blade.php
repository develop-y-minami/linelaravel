{{--サービス提供者ユーザー登録モーダル--}}
<div id="{{ $id }}" class="modal modalServiceProviderUserRegister {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtProviderId" value="{{ $providerId }}">
    </div>
    <div class="container">
        <header>
            <div class="title">サービス提供者ユーザー情報</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--アカウント種別--}}
            <div id="{{ $id }}RadioUserAccountTypeContainer" class="row">
                <div>アカウント種別</div>
                <div class="inputContainer">
                    <div class="radioBox">
                        <input type="radio" id="{{ $id }}RadioUserAccountTypeUser" name="{{ $id }}RadioUserAccountType" value="{{ \UserAccountType::USER }}" checked>
                        <label for="{{ $id }}RadioUserAccountTypeUser">一般</label>
                    </div>
                    <div class="radioBox">
                        <input type="radio" id="{{ $id }}RadioUserAccountTypeAdmin" name="{{ $id }}RadioUserAccountType" value="{{ \UserAccountType::ADMIN }}">
                        <label for="{{ $id }}RadioUserAccountTypeAdmin">管理者</label>
                    </div>
                </div>
            </div>

            {{--アカウントID--}}
            <div class="row">
                <div>アカウントID</div>
                <input type="text" id="{{ $id }}TxtAccountId" class="large" maxlength="" placeholder="アカウントIDを入力">
            </div>

            {{--名前--}}
            <div class="row">
                <div>名前</div>
                <input type="text" id="{{ $id }}TxtName" class="large" maxlength="" placeholder="名前を入力">
            </div>

            {{--メールアドレス--}}
            <div class="row">
                <div>メールアドレス</div>
                <input type="text" id="{{ $id }}TxtEmail" class="large" maxlength="" placeholder="メールアドレスを入力">
            </div>

            {{--パスワード--}}
            <div class="row">
                <div>パスワード</div>
                <input type="password" id="{{ $id }}TxtPassword" class="large" maxlength="" placeholder="パスワードを入力">
            </div>

            {{--パスワード--}}
            <div class="row">
                <div>パスワード（確認入力）</div>
                <input type="password" id="{{ $id }}TxtPasswordConfirm" class="large" maxlength="" placeholder="パスワードを入力">
            </div>

            {{--エラーメッセージ--}}
            <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>

            <div class="row">
                <button id="{{ $id }}BtnRegister" class="blue large">登録</button>
            </div>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>