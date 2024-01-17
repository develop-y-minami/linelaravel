{{--担当者削除モーダル--}}
<div id="{{ $id }}" class="modal modalUserDelete {{ $class }}">
    <div class="container">
        <header>
            <div class="title">担当者削除</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--サービス提供者--}}
            @php $selServiceProviderId = $id.'SelServiceProvider' @endphp
            <div id="{{ $id }}ServiceProviderContainer" class="row hideContainer" {!! \AppViewFacade::hideLoginUserIsServiceProvider() !!}>
                <div>サービス提供者</div>
                <x-selects.serviceProvider :id='$selServiceProviderId' :selectItems='$serviceProviderSelectItems' :selectedValue="Auth::user()->service_provider_id"></x-selects.serviceProvider>
            </div>

            <div class="row gridContainer">
                <div id="{{ $id }}Grid" class="grid ag-theme-material"></div>
            </div>

            <div class="buttonContainer">
                {{--エラーメッセージ--}}
                <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>
                {{--ボタン--}}
                <button id="{{ $id }}BtnDelete" class="red">削除</button>
            </div>
        </main>
    </div>

    <div id="{{ $id }}Overlay" class="overlay">
        <div class="container">
            {{--担当者削除確認モーダル--}}
            <x-modals.confirm id="{{ $id }}UserDeleteModalConfirm" message="担当者を削除しますか？"></x-modals.confirm>
        </div>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>