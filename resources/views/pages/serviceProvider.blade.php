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
    {{--担当者入力モーダル--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/userInputModal.css') }}">
    {{--担当者削除モーダル--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/userDeleteModal.css') }}">
    {{--サービス提供者入力モーダル--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/serviceProviderInputModal.css') }}">
    {{--LINE設定モーダル--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/lineSettingModal.css') }}">
    {{--サービス提供者情報ページ--}}
    <link rel="stylesheet" href="{{ asset('css/pages/serviceProvider.css') }}">
@endpush

@push('js')
    {{--Chart js--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{--AG Grid--}}
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script src="{{ asset('js/commons/components/grids/agGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/buttonCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/labelBoxCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/linkCellRenderer.js') }}"></script>
    {{--担当者 Grid--}}
    <script src="{{ asset('js/commons/components/grids/userGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/userCellRenderer.js') }}"></script>
    {{--LINE Grid--}}
    <script src="{{ asset('js/commons/consts/lineAccountStatus.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/lineCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    {{--担当者入力モーダル--}}
    <script src="{{ asset('js/commons/components/modals/userInputModal.js') }}"></script>
    {{--担当者削除モーダル--}}
    <script src="{{ asset('js/commons/components/modals/userDeleteModal.js') }}"></script>
    {{--担当者API--}}
    <script src="{{ asset('js/apis/userApi.js') }}"></script>
    {{--サービス提供者入力モーダル--}}
    <script src="{{ asset('js/commons/components/modals/serviceProviderInputModal.js') }}"></script>
    {{--LINE設定モーダル--}}
    <script src="{{ asset('js/commons/components/modals/lineSettingModal.js') }}"></script>
    {{--サービス提供者担当者連携セレクトボックス--}}
    <script src="{{ asset('js/commons/components/selectBoxs/serviceProviderUserSelectBox.js') }}"></script>
    {{--グラフ--}}
    <script src="{{ asset('js/commons/components/charts/myChart.js') }}"></script>
    <script src="{{ asset('js/commons/components/charts/doughnuts/doughnutChart.js') }}"></script>
    {{--LINEトークタイプドーナッツグラフ--}}
    <script src="{{ asset('js/commons/consts/lineAccountType.js') }}"></script>
    <script src="{{ asset('js/commons/components/charts/doughnuts/lineAccountTypeDoughnutChart.js') }}"></script>
    {{--LINE状態ドーナッツグラフ--}}
    <script src="{{ asset('js/commons/components/charts/doughnuts/lineAccountStatusDoughnutChart.js') }}"></script>
    {{--LINEユーザードーナッツグラフ--}}
    <script src="{{ asset('js/commons/components/charts/doughnuts/lineUserDoughnutChart.js') }}"></script>
    {{--LINE数推移棒グラフ--}}
    <script src="{{ asset('js/commons/consts/term.js') }}"></script>
    <script src="{{ asset('js/commons/components/containers/dateBarChartContainer.js') }}"></script>
    <script src="{{ asset('js/commons/components/charts/bars/barChart.js') }}"></script>
    <script src="{{ asset('js/commons/components/charts/bars/dateBarChart.js') }}"></script>
    <script src="{{ asset('js/commons/components/charts/bars/lineTransitionBarChart.js') }}"></script>
    {{--サービス提供者API--}}
    <script src="{{ asset('js/apis/serviceProviderApi.js') }}"></script>
    {{--サービス提供者情報ページ--}}
    <script src="{{ asset('js/commons/consts/serviceProviderUseStop.js') }}"></script>
    <script src="{{ asset('js/commons/consts/lineSettingMode.js') }}"></script>
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
                    <div id="useStop" class="labelBox
                        {{ \AppViewFacade::serviceProviderUseStopLabelBoxColor($data->serviceProvider->use_stop) }}"
                        data-value="{{ $data->serviceProvider->use_stop }}"
                        >
                        {{ \ServiceProviderUseStop::getName($data->serviceProvider->use_stop) }}
                    </div>
                    <div class="caption itemName">サービス提供者情報</div>
                </div>
                <div class="profile">
                    <div class="row">
                        <div class="itemName">提供者ID</div>
                        <div id="providerId" class="data">{{ $data->serviceProvider->provider_id }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">提供者名</div>
                        <div id="name" class="data">{{ $data->serviceProvider->name }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">利用開始日</div>
                        <div id="useStartDateTime" class="data"
                            data-value="{{ \ViewFacade::convertDate($data->serviceProvider->use_start_date_time) }}">
                            {{ \ViewFacade::convertJpDate($data->serviceProvider->use_start_date_time) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="itemName">利用終了日</div>
                        <div id="useEndDateTime" class="data"
                            data-value="{{ \ViewFacade::convertDate($data->serviceProvider->use_end_date_time) }}">
                            {{ \ViewFacade::convertJpDate($data->serviceProvider->use_end_date_time) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="itemName">更新日時</div>
                        <div id="updatedAt" class="data">{{ \ViewFacade::convertJpDateTime($data->serviceProvider->updated_at) }}</div>
                    </div>
                    <div class="row">
                        <div class="itemName">登録日時</div>
                        <div id="createdAt" class="data">{{ \ViewFacade::convertJpDateTime($data->serviceProvider->created_at) }}</div>
                    </div>
                </div>
            </div>

            {{--担当者情報--}}
            <div class="contentContainer userContainer">
                <div class="caption itemName">担当者情報</div>
                <div class="profile">
                    <div class="row">
                        <div class="itemName">担当者数</div>
                        <div id="userCount" class="data"></div>
                    </div>
                </div>
                {{--担当者グリッド--}}
                <div id="userGrid" class="grid ag-theme-material"></div>
            </div>

            {{--LINE情報--}}
            <div class="contentContainer lineContainer">
                <div class="caption itemName">LINE情報</div>
                <div class="profile">
                    <div class="row">
                        <div class="itemName">LINE数</div>
                        <div id="lineCount" class="data"></div>
                    </div>
                    <div class="row">
                        <div class="itemName">有効LINE数</div>
                        <div id="lineValidCount" class="data"></div>
                    </div>
                </div>
                <div class="statisticsContainer">
                    <div class="doughnutChartContainer">
                        {{-- LINEトークタイプドーナッツグラフ --}}
                        <x-charts.doughnuts.lineAccountType :serviceProviderId='$data->serviceProvider->id'></x-charts.doughnuts.lineAccountType>
                        {{-- LINE状態ドーナッツグラフ --}}
                        <x-charts.doughnuts.lineAccountStatus :serviceProviderId='$data->serviceProvider->id'></x-charts.doughnuts.lineAccountStatus>
                        {{-- LINEユーザードーナッツグラフ --}}
                        <x-charts.doughnuts.lineUser :serviceProviderId='$data->serviceProvider->id'></x-charts.doughnuts.lineUser>
                    </div>
                    {{--LINE数推移棒グラフ--}}
                    <x-containers.dateBarChart>
                        <x-charts.bars.lineTransition :serviceProviderId='$data->serviceProvider->id'></x-charts.bars.lineTransition>
                    </x-containers.dateBarChart>
                </div>
                {{--LINEグリッド--}}
                <div id="lineGrid" class="grid ag-theme-material"></div>
            </div>
        </main>

        <aside class="rightSubMenu">
            <ul class="subMenu">
                <li><div id="edit" class="menu">サービス提供者編集</div></li>
                <li><div id="delete" class="menu">サービス提供者削除</div></li>
                <li><div id="userRegister" class="menu">担当者追加</div></li>
                <li><div id="userDelete" class="menu">担当者削除</div></li>
                <li><div id="lineSetting" class="menu">LINE設定</div></li>
                <li><div id="lineSettingRelease" class="menu">LINE設定解除</div></li>
            </ul>
        </aside>

        <div id="overlay" class="overlay">
            <div class="container">
                {{--サービス提供者入力モーダル--}}
                <x-modals.serviceProviderInput :mode='\EditMode::UPDATE'></x-modals.serviceProviderInput>
                {{--サービス提供者削除確認モーダル--}}
                <x-modals.confirm id="serviceProviderDeleteModalConfirm" message="サービス提供者を削除しますか？"></x-modals.confirm>
                {{--担当者入力モーダル--}}
                <x-modals.userInput
                    :userTypeRadioItems='$data->userTypeRadioItems'
                    :serviceProviderSelectItems='$data->serviceProviderSelectItems'
                    :userAccountTypeRadioItems='$data->userAccountTypeRadioItems'>
                </x-modals.userInput>
                {{--担当者削除モーダル--}}
                <x-modals.userDelete :serviceProviderSelectItems='$data->serviceProviderSelectItems'></x-modals.userDelete>
                {{--LINE設定モーダル--}}
                <x-modals.lineSetting
                    id="modalLineSettingSetting" 
                    :settingServiceProviderId='$data->serviceProvider->id'
                    :serviceProviderSelectItems='$data->serviceProviderSelectItems'
                    :userSelectItems='$data->userSelectItems'>
                </x-modals.lineSetting>
                <x-modals.lineSetting
                    id="modalLineSettingRelease" 
                    :mode='\LineSettingMode::RELEASE["value"]'
                    :settingServiceProviderId='$data->serviceProvider->id'
                    :serviceProviderSelectItems='$data->serviceProviderSelectItems'
                    :userSelectItems='$data->userSelectItems'>
                </x-modals.lineSetting>
            </div>
        </div>
    </div>
@endsection