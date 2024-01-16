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
                <x-selects.serviceProvider :id='$selServiceProviderId' class="large" classBox="full" :selectItems='$serviceProviderSelectItems' :selectedValue="Auth::user()->service_provider_id"></x-selects.serviceProvider>
            </div>

            <div class="row gridContainer">

            </div>

            {{--エラーメッセージ--}}
            <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>

            <div class="row">
                <button id="{{ $id }}BtnDelete" class="red large">削除</button>
            </div>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>