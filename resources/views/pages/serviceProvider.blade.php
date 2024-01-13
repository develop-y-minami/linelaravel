{{--baseGridレイアウトを継承--}}
@extends('layouts.baseGrid')

{{--タイトルを設定--}}
@section('title', 'サービス提供者')

{{--CSS--}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/serviceProviderInputModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/serviceProviderUserRegisterModal.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/commons/components/modals/serviceProviderInputModal.js') }}"></script>
    <script src="{{ asset('js/commons/components/modals/serviceProviderUserRegisterModal.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/serviceProviderGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/serviceProviderCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/serviceProviderApi.js') }}"></script>
    <script src="{{ asset('js/apis/userApi.js') }}"></script>
    <script src="{{ asset('js/pages/serviceProvider.js') }}"></script>
@endpush

{{--見出し--}}
@section('pageCaption')
    <div class="caption">サービス提供者</div>
    <div class="comment">サービス提供者の一覧を表示します</div>
@endsection

{{--検索条件--}}
@section('searchConditions')
    {{--サービス提供者IDテキストボックス--}}
    <div class="content">
        <input type="text" id="txtProviderId" placeholder="提供者IDを入力">
    </div>
    {{--サービス提供者名テキストボックス--}}
    <div class="content">
        <input type="text" id="txtName" placeholder="提供者名を入力">
    </div>
    {{--利用期間ボックス--}}
    <div class="content inputContainer">
        <span class="">利用期間</span>
        <input type="date" id="txtUseStartDateTime">
        <span>～</span>
        <input type="date" id="txtUseEndDateTime">
    </div>
    {{--サービス利用状態セレクトボックス--}}
    <div class="content">
        <x-selects.serviceProviderUseStop></x-selects.serviceProviderUseStop>
    </div>
    {{--検索ボタン--}}
    <div class="content">
        <button id="btnSearch" class="blue">検索</button>
    </div>
@endsection

@section('rightContents')
    {{--新規追加ボタン--}}
    <div class="content">
        <button id="btnInsert" class="blue" {!! \ViewFacade::hide(\AppFacade::loginUserIsUser()) !!}>新規追加</button>
    </div>
@endsection

@section('overlayContents')
    {{--サービス提供者入力モーダル--}}
    <x-modals.serviceProviderInput id="modalServiceProviderInputRegister"></x-modals.serviceProviderInput>
    <x-modals.serviceProviderInput id="modalServiceProviderInputUpdate" :mode='\EditMode::UPDATE'></x-modals.serviceProviderInput>
    {{--ユーザー登録確認モーダル--}}
    <x-modals.confirm id="userRegisterModalConfirm" message="管理者アカウントを追加しますか？"></x-modals.confirm>
    {{--サービス提供者ユーザー登録モーダル--}}
    <x-modals.serviceProviderUserRegister></x-modals.serviceProviderUserRegister>
    {{--サービス提供者削除確認モーダル--}}
    <x-modals.confirm id="serviceProviderDeleteModalConfirm" message="サービス提供者を削除しますか？"></x-modals.confirm>
@endsection