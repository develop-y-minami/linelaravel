{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', '１対１トーク')

{{--CSS--}}
@push('css')
    {{--AG Grid--}}    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-grid.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-theme-material.css"/>
    <link rel="stylesheet" href="{{ asset('css/commons/agGrid.css') }}">
    {{--１対１トークページCSS--}}
    <link rel="stylesheet" href="{{ asset('css/pages/lineOneToOne.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    {{--AG Grid--}}
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script src="{{ asset('js/commons/consts/lineAccountStatus.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/agGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/labelBoxCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/linkCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    <script src="{{ asset('js/pages/lineOneToOne.js') }}"></script>
@endpush

{{--表示コンテンツ：１対１トークページ--}}
@section('page')
    <div class="lineOneToOnePageContainer">
        {{--非表示領域--}}
        <div class="hideContainer">
            <input type="text" id="txtLineAccountTypeId" value="{{ $data->lineAccountTypeId }}">
        </div>

        {{--見出し--}}
        <div class="pageCaption">
            <div class="caption">１対１トークリスト</div>
            <div class="comment">公式<span class="line">LINE</span>と１対１トークをしている<span class="line">LINE</span>の一覧を表示します</div>
        </div>

        {{--通知リストコンテナー--}}
        <div class="lineListContainer">
            <div class="topContainer">
                <div class="searchContainer">
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
                </div>
                <div class="rightContainer">
                    {{--リロードボタン--}}
                    <div class="content">
                        <x-buttons.reload id="btnReload"></x-buttons.reload>
                    </div>
                </div>
            </div>

            <div class="gridContainer">
                {{--通知リストグリッド--}}
                <div id="lineGrid" class="grid ag-theme-material"></div>
            </div>
        </div>
    </div>
@endsection