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
    <div class="settingServiceProviderPage">
        {{--提供者ID--}}
        <div class="row">
            <div class="inputLabel">提供者ID</div>
            <input type="text" id="txtProviderId" class="large" maxlength="{{ \Length::SERVICE_PROVIDER_PROVIDER_ID }}" placeholder="提供者IDを入力">
        </div>
        <div class="row">
            <button id="btnSetting" class="blue large">設定</button>
        </div>
    </div>
@endsection