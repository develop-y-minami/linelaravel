{{--LINEトーク履歴コンテナー--}}
<div id='{{ $id }}' class="lineTalkHistoryContainer {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtLineId" value="{{ $lineId }}">
    </div>
    <header>
        <div class="caption">トーク履歴</div>
    </header>
    <main>
        {{--LINEトークコンテナー--}}
        <x-containers.lineTalk :lineId='$lineId'></x-containers.lineTalk>
    </main>
    <footer>
        {{--送信メッセージ--}}
        <div class="messageContainer">
            <textarea id="{{ $id }}TxtSendMessage" rows="6" placeholder="送信メッセージを入力"></textarea>
        </div>
        {{--ボタン--}}
        <div class="buttonContainer">
            <button id="{{ $id }}BtnMessageTemlate" class="green">メッセージテンプレート</button>
            <button id="{{ $id }}BtnSend" class="blue">送信</button>
        </div>
    </footer>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>