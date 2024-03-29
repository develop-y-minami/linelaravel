{{--baseGridレイアウトを継承--}}
@extends('layouts.baseGrid')

{{--タイトルを設定--}}
@section('title', 'トップ')

{{--JavaScript--}}
@push('pageJs')
    {{--LINE通知Grid--}}
    <script src="{{ asset('js/commons/consts/lineNoticeType.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineNoticeGrid.js') }}"></script>
    {{--サービス提供者担当者連携セレクトボックス--}}
    <script src="{{ asset('js/commons/components/selectBoxs/serviceProviderUserSelectBox.js') }}"></script>
    {{--LINEAPI--}}
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    {{--トップページ--}}
    <script src="{{ asset('js/pages/top.js') }}"></script>
@endpush

{{--見出し--}}
@section('pageCaption')
    <div class="caption">通知リスト</div>
    <div class="comment">公式<span class="fc-green fw-bold">LINE</span>の通知一覧を表示します</div>
@endsection

{{--検索条件--}}
@section('searchConditions')
    {{--LINE通知日テキストボックス--}}
    <div class="content">
        <input type="date" id="txtLineNoticeDate" value="{{ $data->lineNoticeDate }}">
    </div>
    {{--サービス提供者セレクトボックス--}}
    <div class="content" {!! \ViewFacade::hide(\AppFacade::loginUserIsServiceProvider()) !!}>
        <x-selects.serviceProvider :selectItems='$data->serviceProviderSelectItems' :selectedValue="Auth::user()->service_provider_id"></x-selects.serviceProvider>
    </div>
    {{--担当者セレクトボックス--}}
    <div class="content">
        <x-selects.user id="selUser" :selectItems='$data->userSelectItems'></x-selects.user>
    </div>
    {{--通知種別セレクトボックス--}}
    <div class="content">
        <x-selects.lineNoticeType :selectItems='$data->lineNoticeTypeSelectItems'></x-selects.lineNoticeType>
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