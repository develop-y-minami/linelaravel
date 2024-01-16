{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--CSS--}}
@push('css')
    {{--AG Grid--}}    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-grid.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-theme-material.css"/>
    <link rel="stylesheet" href="{{ asset('css/commons/agGrid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/baseGrid.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    {{--AG Grid--}}
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script src="{{ asset('js/commons/components/grids/agGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/buttonCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/labelBoxCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/linkCellRenderer.js') }}"></script>
    @stack('pageJs')
@endpush

@section('page')
    <div class="gridPageContainer">
        {{--見出し--}}
        <div class="pageCaption">
            @yield('pageCaption')
        </div>

        <main>
            <div class="topContainer">
                {{--検索条件--}}
                <div class="searchContainer">
                    @yield('searchConditions')
                </div>
                <div class="centerContainer">
                    <div class="content">
                        <div class="switchContainer">
                            <div class="caption">表示モード切替</div>
                            <label class="switch">
                                <input id="checkSwitch" type="checkbox"/>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="rightContainer">
                    @yield('rightContents')
                    {{--リロードボタン--}}
                    <div class="content">
                        <x-buttons.reload id="btnReload"></x-buttons.reload>
                    </div>
                </div>
            </div>

            <div class="gridContainer">
                {{--グリッド--}}
                <div id="grid" class="grid ag-theme-material"></div>
            </div>
        </main>

        <div id="overlay" class="overlay">
            <div class="container">
                @yield('overlayContents')
            </div>
        </div>
    </div>
@endsection