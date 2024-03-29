{{--baseGridレイアウトを継承--}}
@extends('layouts.baseGrid')

{{--タイトルを設定--}}
@section('title', '１対１トーク')

{{--JavaScript--}}
@push('pageJs')
    {{--LINEGrid--}}
    <script src="{{ asset('js/commons/consts/lineAccountStatus.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/lineCellRenderer.js') }}"></script>
    {{--サービス提供者担当者連携セレクトボックス--}}
    <script src="{{ asset('js/commons/components/selectBoxs/serviceProviderUserSelectBox.js') }}"></script>
    {{--LINEAPI--}}
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    {{--１対１トークページ--}}
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
    <div class="content" {!! \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider()) !!}>
        <x-selects.serviceProvider :selectItems='$data->serviceProviderSelectItems' :selectedValue="Auth::user()->service_provider_id"></x-selects.serviceProvider>
    </div>
    {{--担当者セレクトボックス--}}
    <div class="content">
        <x-selects.user :selectItems='$data->userSelectItems'></x-selects.user>
    </div>
    {{--LINEアカウント状態セレクトボックス--}}
    <div class="content">
        <x-selects.lineAccountStatus :selectItems='$data->lineAccountStatusSelectItems'></x-selects.lineAccountStatus>
    </div>
    {{--トーク相手/グループテキストボックス--}}
    <div class="content">
        <input type="text" id="txtLineChannelDisplayName" placeholder="LINEを入力">
    </div>
    {{--検索ボタン--}}
    <div class="content">
        <button id="btnSearch" class="blue">検索</button>
    </div>
@endsection