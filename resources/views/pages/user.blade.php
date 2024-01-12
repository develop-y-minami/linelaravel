{{--baseGridレイアウトを継承--}}
@extends('layouts.baseGrid')

{{--タイトルを設定--}}
@section('title', '担当者')

{{--CSS--}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/userInputModal.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/commons/components/modals/userInputModal.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/userGrid.js') }}"></script>
    <script src="{{ asset('js/apis/userApi.js') }}"></script>
    <script src="{{ asset('js/pages/user.js') }}"></script>
@endpush

{{--見出し--}}
@section('pageCaption')
    <div class="caption">担当者</div>
    <div class="comment">担当者の一覧を表示します</div>
@endsection

{{--検索条件--}}
@section('searchConditions')
    {{--担当者種別セレクトボックス--}}
    <div class="content" {!! \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider()) !!}>
        @if (Auth::user()->user_type_id == \UserType::OPERATOR)
            @php $userTypeSelectedValue = '0' @endphp
        @else
            @php $userTypeSelectedValue = \UserType::SERVICE_PROVIDER @endphp
        @endif
        <x-selects.userType :selectItems='$data->userTypeSelectItems' :selectedValue="$userTypeSelectedValue"></x-selects.userType>
    </div>
    {{--サービス提供者セレクトボックス--}}
    <div class="content" {!! \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider()) !!}>
        <x-selects.serviceProvider :selectItems='$data->serviceProviderSelectItems' :selectedValue="Auth::user()->service_provider_id"></x-selects.serviceProvider>
    </div>
    {{--担当者アカウント種別セレクトボックス--}}
    <div class="content">
        <x-selects.userAccountType :selectItems='$data->userAccountTypeSelectItems' blankItemName="アカウント種別を選択"></x-selects.userAccountType>
    </div>
    {{--アカウントIDテキストボックス--}}
    <div class="content">
        <input type="text" id="txtAccountId" placeholder="アカウントIDを入力">
    </div>
    {{--担当者名テキストボックス--}}
    <div class="content">
        <input type="text" id="txtName" placeholder="担当者名を入力">
    </div>
    {{--検索ボタン--}}
    <div class="content">
        <button id="btnSearch" class="blue">検索</button>
    </div>
@endsection

@section('rightContents')
    {{--新規追加ボタン--}}
    <div class="content">
        <button id="btnInsert" class="blue">新規追加</button>
    </div>
@endsection

@section('overlayContents')
    {{--担当者入力モーダル--}}
    <x-modals.userInput id="modalUserInputRegister"></x-modals.userInput>
@endsection