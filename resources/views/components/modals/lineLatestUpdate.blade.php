{{--LINE最新情報更新モーダル--}}
<div id="{{ $id }}" class="modal modalLineLatestUpdate {{ $class }}">
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtLineId" value="{{ $lineId }}">
    </div>
    <div class="container">
        <header>
            <div class="title">LINE最新情報更新</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--LINEプロフィール情報コンテナー--}}
            @php $lineProfileId = $id.'LineProfileContainer' @endphp
            <x-containers.lineProfile :id='$lineProfileId' :lineId='$lineId'></x-containers.lineProfile>
            {{--エラーメッセージ--}}
            <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>
            {{--最新情報で更新ボタン--}}
            <button id="{{ $id }}BtnUpdate" class="green large">最新情報で更新</button>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>