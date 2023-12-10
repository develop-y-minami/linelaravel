{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'トップ')

{{--CSS--}}
@push('css')
    {{--AG Grid--}}    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-grid.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-theme-material.css"/>
    <link rel="stylesheet" href="{{ asset('css/commons/agGrid.css') }}">
    {{--トップページCSS--}}
    <link rel="stylesheet" href="{{ asset('css/pages/top.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    {{--AG Grid--}}
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script src="{{ asset('js/commons/components/grids/agGrid.js') }}"></script>
    <script src="{{ asset('js/commons/consts/lineNoticeType.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineNoticeGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/labelBoxCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/linkCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    <script src="{{ asset('js/pages/top.js') }}"></script>
@endpush

{{--表示コンテンツ：トップページ--}}
@section('page')
    <div class="topPageContainer">
        {{--見出し--}}
        <div class="pageCaption">
            <div class="caption">通知リスト</div>
            <div class="comment">公式<span class="line">LINE</span>の通知一覧を表示します</div>
        </div>

        {{--通知リストコンテナー--}}
        <div class="lineNoticeListContainer">
            <div class="topContainer">
                <div class="searchContainer">
                    {{--LINE通知日テキストボックス--}}
                    <div class="content">
                        <input type="date" id="txtSearchLineNoticeDate" value="{{ $data->lineNoticeDate }}">
                    </div>
                    {{--担当者セレクトボックス--}}
                    <div class="content">
                        <x-selects.user id="selSearchUser" :selectItems='$data->userSelectItems'></x-selects.user>
                    </div>
                    {{--通知種別セレクトボックス--}}
                    <div class="content">
                        <x-selects.lineNoticeType id="selSearchLineNoticeType" :selectItems='$data->lineNoticeTypeSelectItems'></x-selects.lineNoticeType>
                    </div>
                    {{--トーク相手/グループテキストボックス--}}
                    <div class="content">
                        <input type="text" id="txtSearchLineDisplayName" placeholder="トーク相手/グループを入力">
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
                <div id="lineNoticeGrid" class="grid ag-theme-material"></div>
            </div>
        </div>
    </div>
@endsection