{{--LINEトークコンテナー--}}
<div id="{{ $id }}" class="lineTalkContainer {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtLineId" value="{{ $lineId }}">
    </div>
    <header>
        <div class="selectBox">
            @php $lineTalkHistoryTerm = $id.'SelLineTalkHistoryTerm' @endphp
            <x-selects.lineTalkHistoryTerm :id='$lineTalkHistoryTerm'></x-selects.lineTalkHistoryTerm>
        </div>
        <div class="rightContainer">
            <button id='{{ $id }}BtnLineTalkHistory' class="green">トーク履歴一覧ページへ</button>
            @php $reloadId = $id.'BtnReload' @endphp
            <x-buttons.reload :id='$reloadId'></x-buttons.reload>
        </div>
    </header>
    <main>
        <div id="{{ $id }}TalkContainer" class="talkContainer">
            <div class="container">
                <div class="separator">
                    <div></div>
                    <div>2023年12月21日</div>
                    <div></div>
                </div>
            </div>
            <div class="container">
                <div class="labelContainer">
                    <div class="caption">10時35分50秒</div>
                    <div class="label">ブロック</div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer to">
                    <div class="caption">
                        <div>10時35分50秒</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer to">
                    <div class="caption">
                        <div>10時35分50秒</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="messageContainer from">
                    <div class="caption">
                        <div>10時35分50秒</div>
                        <div>送信者：田中　太郎</div>
                    </div>
                    <div class="messageBox">
                        <div class="message">aaaaaaaaaaaaa</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>