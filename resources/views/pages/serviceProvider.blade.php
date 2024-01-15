{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'サービス提供者情報')

{{--CSS--}}
@push('css')
    {{--AG Grid--}}    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-grid.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-theme-material.css"/>
    <link rel="stylesheet" href="{{ asset('css/commons/agGrid.css') }}">
    {{--サービス提供者情報ページ--}}
    <link rel="stylesheet" href="{{ asset('css/pages/serviceProvider.css') }}">
@endpush

@push('js')
    {{--AG Grid--}}
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script src="{{ asset('js/commons/components/grids/agGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/buttonCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/labelBoxCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/linkCellRenderer.js') }}"></script>
    {{--担当者 Grid--}}
    <script src="{{ asset('js/commons/components/grids/userGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/userCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/userApi.js') }}"></script>
    {{--LINE Grid--}}
    <script src="{{ asset('js/commons/consts/lineAccountStatus.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/lineCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    {{--サービス提供者情報ページ--}}
    <script src="{{ asset('js/pages/serviceProvider.js') }}"></script>
@endpush

{{--表示コンテンツ：サービス提供者情報ページ--}}
@section('page')
    <div class="serviceProviderPageContainer">
        <main>
            {{--非表示領域--}}
            <div class="hideContainer">
                <input type="text" id="textServiceProviderId" value="{{ $data->serviceProvider->id }}">
            </div>
            {{--サービス提供者情報--}}
            <div class="contentContainer serviceProviderContainer">
                <div class="itemBox">
                    <div class="labelBox
                        {{ \AppViewFacade::serviceProviderUseStopLabelBoxColor($data->serviceProvider->use_stop) }}">
                        {{ \ServiceProviderUseStop::getName($data->serviceProvider->use_stop) }}
                    </div>
                    <div class="caption itemName">サービス提供者情報</div>
                </div>
                <div class="profile">
                    <div class="row">
                        <div class="itemName">提供者ID</div>
                        <div class="data">{{ $data->serviceProvider->provider_id }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">提供者名</div>
                        <div class="data">{{ $data->serviceProvider->name }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">利用開始日</div>
                        <div class="data">{{ \ViewFacade::convertJpDate($data->serviceProvider->use_start_date_time) }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">利用終了日</div>
                        <div class="data">{{ \ViewFacade::convertJpDate($data->serviceProvider->use_end_date_time) }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">更新日時</div>
                        <div class="data">{{ \ViewFacade::convertJpDateTime($data->serviceProvider->updated_at) }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">登録日時</div>
                        <div class="data">{{ \ViewFacade::convertJpDateTime($data->serviceProvider->created_at) }}</div>
                    </div>
                </div>
            </div>

            {{--担当者情報--}}
            <div class="contentContainer gridContainer">
                <div class="caption itemName">担当者情報</div>
                <div id="userGrid" class="grid ag-theme-material"></div>
            </div>

            {{--LINE情報--}}
            <div class="contentContainer gridContainer">
                <div class="caption itemName">LINE情報</div>
                <div id="lineGrid" class="grid ag-theme-material"></div>
            </div>
        </main>

        <aside class="rightSubMenu">
            <ul class="subMenu">
                <li><div id="edit" class="menu">サービス提供者編集</div></li>
                <li><div id="delete" class="menu">サービス提供者削除</div></li>
                <li><div id="userRegister" class="menu">担当者追加</div></li>
            </ul>
        </aside>

        <div id="overlay" class="overlay">
            <div class="container">

            </div>
        </div>
    </div>
@endsection