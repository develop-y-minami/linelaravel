{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', '担当者情報')

{{--CSS--}}
@push('css')
    {{--AG Grid--}}    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-grid.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-theme-material.css"/>
    <link rel="stylesheet" href="{{ asset('css/commons/agGrid.css') }}">
    {{--担当者情報ページ--}}
    <link rel="stylesheet" href="{{ asset('css/pages/user.css') }}">
@endpush

@push('js')
    {{--AG Grid--}}
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <script src="{{ asset('js/commons/components/grids/agGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/buttonCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/labelBoxCellRenderer.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/linkCellRenderer.js') }}"></script>
    {{--LINE Grid--}}
    <script src="{{ asset('js/commons/consts/lineAccountStatus.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/lineGrid.js') }}"></script>
    <script src="{{ asset('js/commons/components/grids/cellRenderers/lineCellRenderer.js') }}"></script>
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    {{--担当者情報ページ--}}
    <script src="{{ asset('js/pages/user.js') }}"></script>
@endpush

{{--表示コンテンツ：担当者情報ページ--}}
@section('page')
    <div class="userPageContainer">
        <main>
            {{--非表示領域--}}
            <div class="hideContainer">
                <input type="text" id="textUserId" value="{{ $data->user->id }}">
            </div>
            {{--サービス提供者情報--}}
            <div class="contentContainer serviceProviderContainer">
                <div class="itemBox">
                    <div class="labelBox
                        {{ \AppViewFacade::serviceProviderUseStopLabelBoxColor($data->user->serviceProvider->use_stop) }}">
                        {{ \ServiceProviderUseStop::getName($data->user->serviceProvider->use_stop) }}
                    </div>
                    <div class="caption itemName">サービス提供者</div>
                    <a href="{{ route('serviceProvider', ['id' => $data->user->serviceProvider->id]) }}">{{ $data->user->serviceProvider->name }}</a>
                </div>
            </div>

            {{--担当者情報--}}
            <div class="contentContainer userContainer">
                <div class="caption itemName">担当者情報</div>
                <div class="profileContainer">
                    {{--プロフィール画像--}}
                    <div class="circleImgContainer">
                        <div class="imgBox">
                            <a href="{{ $data->user->profile_image_file_path }}"><img src="{{ $data->user->profile_image_file_path }}"></a>
                        </div>
                    </div>
                    {{--プロフィール情報コンテナー--}}
                    <div class="infoContainer">
                        {{--プロフィール情報--}}
                        <div class="profile">
                            <div class="row">
                                <div class="itemName">担当者種別</div>
                                <div class="data">{{ $data->user->userType->name }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">アカウント種別</div>
                                <div class="data">{{ $data->user->userAccountType->name }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">アカウントID</div>
                                <div class="data">{{ $data->user->account_id }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">担当者名</div>
                                <div class="data">{{ $data->user->name }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">更新日時</div>
                                <div class="data">{{ \ViewFacade::convertJpDateTime($data->user->updated_at) }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">登録日時</div>
                                <div class="data">{{ \ViewFacade::convertJpDateTime($data->user->created_at) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--LINE情報--}}
            <div class="contentContainer gridContainer">
                <div class="caption itemName">LINE情報</div>
                <div id="lineGrid" class="grid ag-theme-material"></div>
            </div>
        </main>

        <aside class="rightSubMenu">
            <ul class="subMenu">
                <li><div id="edit" class="menu">担当者編集</div></li>
                <li><div id="delete" class="menu">担当者削除</div></li>
                <li><div id="delete" class="menu">プロフィール画像変更</div></li>
                <li><div id="delete" class="menu">パスワード変更</div></li>
            </ul>
        </aside>

        <div id="overlay" class="overlay">
            <div class="container">

            </div>
        </div>
    </div>
@endsection