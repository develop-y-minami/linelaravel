{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'LINE情報')

{{--CSS--}}
@push('css')
    {{--LINE情報ページCSS--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/containers/lineUserContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/lineOfUserSettingModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/lineInfo.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    <script src="{{ asset('js/commons/components/modals/lineOfUserSettingModal.js') }}"></script>
    <script src="{{ asset('js/commons/components/lists/checkList.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    <script src="{{ asset('js/pages/lineInfo.js') }}"></script>
@endpush

{{--表示コンテンツ：LINE情報ページ--}}
@section('page')
    <div class="lineInfoPageContainer">
        {{--非表示領域--}}
        <div class="hideContainer">
            <input type="text" id="txtLineId" value="{{ $data->line->id }}">
        </div>

        <div class="splitContainer">
            {{--左コンテナー--}}
            <div class="leftContainer container">
                {{--LINE担当者情報--}}
                <header>
                    <div class="caption">担当者：<span id="userName">{{ $data->line->user->name }}</span></div>
                    <button id="btnLineOfUserSetting" class="blue">担当者設定</button>
                </header>
                <main class="lineInfoContainer">
                    {{--LINE情報コンテナー--}}
                    <x-containers.line :line='$data->line'></x-containers.line>
                    {{--LINEユーザー情報コンテナー--}}
                    <x-containers.lineUser :lineUser='$data->line->lineUser'></x-containers.lineUser>
                </main>

                <div id="leftOverlay" class="overlay">
                    <div class="container">
                        {{--LINE担当者設定モーダル--}}
                        <x-modals.lineOfUserSetting
                            :userSelectItems='$data->userSelectItems'
                            :userSelectedValue='$data->line->user->id'
                            :lineNoticeTypeCheckListItems='$data->lineNoticeTypeCheckListItems'
                            :lineOfUserNotice='$data->line->line_of_user_notice'
                        ></x-modals.lineOfUserSetting>
                    </div>
                </div>
            </div>

            <div class="rightContainer container">
                <header>

                </header>
                <main>

                </main>
            </div>
        </div>
    </div>
@endsection