{{--LINEトークコンテナー--}}
<div id="{{ $id }}" class="lineTalkContainer {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtLineId" value="{{ $lineId }}">
    </div>
    <header>
        <div class="selectBox">
            @php $lineTalkHistoryTerm = $id.'selLineTalkHistoryTerm' @endphp
            <x-selects.lineTalkHistoryTerm id="$lineTalkHistoryTerm"></x-selects.lineTalkHistoryTerm>
        </div>
        <div class="rightContainer">
            <button class="green">トーク履歴一覧ページへ</button>
            @php $reloadId = $id.'BtnReload' @endphp
            <x-buttons.reload id="$reloadId"></x-buttons.reload>
        </div>
    </header>
    <main>
        <div class="talkContainer">
            
        </div>
    </main>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>