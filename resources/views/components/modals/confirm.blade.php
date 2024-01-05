{{--確認モーダル--}}
<div id="{{ $id }}" class="modal modalConfirm {{ $class }}">
    <div class="container">
        <header>
            <div class="title">{{ $title }}</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--メッセージ--}}
            <div id="{{ $id }}Message" class="message">{{ $message }}</div>

            {{--エラーメッセージ--}}
            <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>

            <div class="buttoncontainer">
                <button id="{{ $id }}BtnYes" class="blue large">{{ $btnYesName }}</button>
                <button id="{{ $id }}BtnNo" class="blue large">{{ $btnNoName }}</button>
            </div>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>