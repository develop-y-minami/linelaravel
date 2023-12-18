{{--LINE最新情報更新モーダル--}}
<div id="{{ $id }}" class="modal modalLineLatestUpdate {{ $class }}">
    <div class="container">
        <header>
            <div class="title">LINE最新情報更新</div>
            <button id="{{ $btnCloseId }}" class="close">×</button>
        </header>
        <main>
            {{--LINEプロフィール情報コンテナー--}}
            <x-containers.lineProfile
                :id='$lineProfileContainerId'
                :class='$lineProfileContainerClass'
                :imgPictureUrlId='$imgPictureUrlId'
                :tdDisplayNameId='$tdDisplayNameId'
                :tdLineAccountTypeNameId='$tdLineAccountTypeNameId'
            ></x-containers.lineProfile>
            {{--エラーメッセージ--}}
            <div id="{{ $errorMessageId }}" class="errorMessage"></div>
            {{--最新情報で更新ボタン--}}
            <button id="{{ $btnLineLatestUpdate }}" class="green large">最新情報で更新</button>
        </main>
    </div>

    <div id="{{ $loadingOverlayId }}" class="overlay">
        <div class="loading"></div>
    </div>
</div>