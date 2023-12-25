{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'LINE情報')

{{--CSS--}}
@push('css')
    {{--LINE情報ページCSS--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineInfoContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineProfileContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineUserContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineTalkHistoryContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineTalkContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/lineOfUserSettingModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/lineLatestUpdateModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/lineInfo.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    <script src="{{ asset('js/commons/components/containers/lineInfoContainer.js') }}"></script>
    <script src="{{ asset('js/commons/components/containers/lineContainer.js') }}"></script>
    <script src="{{ asset('js/commons/components/containers/lineProfileContainer.js') }}"></script>
    <script src="{{ asset('js/commons/components/containers/lineTalkHistoryContainer.js') }}"></script>
    <script src="{{ asset('js/commons/components/containers/lineTalkContainer.js') }}"></script>
    <script src="{{ asset('js/commons/components/modals/lineOfUserSettingModal.js') }}"></script>
    <script src="{{ asset('js/commons/components/modals/lineLatestUpdateModal.js') }}"></script>
    <script src="{{ asset('js/commons/components/lists/checkList.js') }}"></script>
    <script src="{{ asset('js/commons/consts/lineNoticeType.js') }}"></script>
    <script src="{{ asset('js/commons/consts/lineSendMessageType.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    <script src="{{ asset('js/pages/lineInfo.js') }}"></script>
@endpush

{{--表示コンテンツ：LINE情報ページ--}}
@section('page')
    <div class="lineInfoPageContainer">
        <div class="splitContainer">
            {{--LINE情報コンテナー--}}
            <x-containers.lineInfo
                class="leftContainer container"
                :line='$data->line'
                :userSelectItems="$data->userSelectItems"
                :lineNoticeTypeCheckListItems="$data->lineNoticeTypeCheckListItems"
            ></x-containers.lineInfo>

            {{--LINEトーク履歴コンテナー--}}
            <x-containers.lineTalkHistory
                class="rightContainer container"
                :lineId='$data->line->id'
            ></x-containers.lineTalkHistory>
        </div>
    </div>
@endsection