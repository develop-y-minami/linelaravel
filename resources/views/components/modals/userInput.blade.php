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