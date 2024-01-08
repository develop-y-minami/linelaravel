{{--baseGridレイアウトを継承--}}
@extends('layouts.baseGrid')

{{--タイトルを設定--}}
@section('title', '１対１トーク')

{{--JavaScript--}}
@push('js')
    {{--AG Grid--}}
    <script src="{{ asset('js/commons/consts/lineAccountStatus.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineGrid.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    <script src="{{ asset('js/pages/lineOneToOne.js') }}"></script>
@endpush

{{--見出し--}}
@section('pageCaption')
    <div class="caption">１対１トークリスト</div>
    <div class="comment">公式<span class="fc-green fw-bold">LINE</span>と１対１トークをしている<span class="fc-green fw-bold">LINE</span>の一覧を表示します</div>
@endsection

{{--検索条件--}}
@section('searchConditions')
    {{--サービス提供者セレクトボックス--}}
    <div class="content">
        <x-selects.serviceProvider id="selSearchUser" :selectItems='$data->serviceProviderSelectItems'></x-selects.serviceProvider>
    </div>
    {{--担当者セレクトボックス--}}
    <div class="content">
        <x-selects.user id="selSearchUser" :selectItems='$data->userSelectItems'></x-selects.user>
    </div>
    {{--LINEアカウント状態セレクトボックス--}}
    <div class="content">
        <x-selects.lineAccountStatus id="selSearchLineAccountStatus" :selectItems='$data->lineAccountStatusSelectItems'></x-selects.lineAccountStatus>
    </div>
    {{--トーク相手/グループテキストボックス--}}
    <div class="content">
        <input type="text" id="txtSearchLineDisplayName" placeholder="LINEを入力">
    </div>
    {{--検索ボタン--}}
    <div class="content">
        <button id="btnSearch" class="blue">検索</button>
    </div>
@endsection