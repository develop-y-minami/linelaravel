{{--レイアウトを継承--}}
@extends('layouts.liff')

{{--タイトルを設定--}}
@section('title', 'サービス提供者設定')

{{--CSS--}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/liffs/pages/settingServiceProvider.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    <script src="{{ asset('js/liffs/settingServiceProvider.js') }}"></script>
@endpush

{{--表示コンテンツ：サービス提供者設定ページ--}}
@section('page')
    {{-- <a href="{{ asset('css/commons/style.css') }}">{{ asset('css/commons/style.css') }}</a><br>
    <a href="{{ asset('css/commons/component.css') }}">{{ asset('css/commons/component.css') }}</a>
    <a href="{{ asset('css/liffs/commons/base.css') }}">{{ asset('css/liffs/commons/base.css') }}</a><br>
    <a href="{{ asset('css/liffs/pages/settingServiceProvider.css') }}">{{ asset('css/liffs/pages/settingServiceProvider.css') }}</a><br>
    <a href="{{ asset('css/liffs/pages/settingServiceProvider.css') }}">{{ asset('css/liffs/pages/settingServiceProvider.css') }}</a><br>
    <a href="{{ asset('js/commons/components/messages/errorMessage.js') }}">{{ asset('js/commons/components/messages/errorMessage.js') }}</a><br>
    <a href="{{ asset('js/apis/fetchApi.js') }}">{{ asset('js/apis/fetchApi.js') }}</a><br>
    <a href="{{ asset('js/apis/liffApi.js') }}">{{ asset('js/apis/liffApi.js') }}</a><br>
    <a href="{{ asset('js/liffs/settingServiceProvider.js') }}">{{ asset('js/liffs/settingServiceProvider.js') }}</a><br> --}}

    <div id="page" class="settingServiceProviderPage">
        {{--非表示領域--}}
        <div class="hideContainer">
            <input type="text" id="txtLiffPageId" value="{{ $data->liffPageId }}">
            <input type="text" id="txtLineId" value="{{ $data->lineId }}">
        </div>
        <div class="pageContainer">
            {{--提供者ID--}}
            <div class="row">
                <div class="inputLabel">提供者ID</div>
                <input type="text" id="txtProviderId" class="large" placeholder="提供者IDを入力">
            </div>

            {{--エラーメッセージ--}}
            <div id="errorMessage" class="errorMessage"></div>

            <div class="row">
                {{--送信ボタン--}}
                <button id="btnPost" class="blue large">送信</button>
            </div>
        </div>

        {{-- サービス提供者確認ページ --}}
        <div id="verifyServiceProviderPage" class="verifyServiceProviderPage">
            <main>
                <div class="caption">
                    以下の提供者情報で間違いないですか？<br>
                    内容にお間違いない場合、設定ボタンをタップしてください
                </div>

                <div class="">
                    
                </div>

                {{--エラーメッセージ--}}
                <div id="verifyServiceProviderErrorMessage" class="errorMessage"></div>

                {{--設定ボタン--}}
                <button id="btnSetting" class="blue large">設定</button>

                {{--戻るボタン--}}
                <button id="btnBack" class="large">戻る</button>
            </main>
        </div>
    </div>
@endsection