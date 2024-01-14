{{--サービス提供者設定モーダル--}}
<div id="{{ $id }}" class="modal modalServiceProviderSetting {{ $class }}">
    <div class="container">
        <header>
            <div class="title">サービス提供者設定</div>
            <button id="{{ $id }}BtnClose" class="close">×</button>
        </header>
        <main>
            {{--サービス提供者--}}
            @php $selServiceProviderId = $id.'SelServiceProvider' @endphp
            <div class="row">
                <div>サービス提供者</div>
                <x-selects.serviceProvider :id='$selServiceProviderId' class="large" classBox="full" :selectItems='$serviceProviderSelectItems' :selectedValue="$serviceProviderSelectedValue"></x-selects.serviceProvider>
            </div>

            {{--エラーメッセージ--}}
            <div id="{{ $id }}ErrorMessage" class="errorMessage"></div>

            <div class="row">
                <button id="{{ $id }}BtnSetting" class="blue large">設定</button>
            </div>
        </main>
    </div>

    <div id="{{ $id }}LoadingOverlay" class="overlay">
        <div class="loading"></div>
    </div>
</div>