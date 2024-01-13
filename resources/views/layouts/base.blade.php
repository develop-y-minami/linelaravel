<!DOCTYPE html>

<html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--タイトル--}}
        <title>@yield('title')</title>

        {{--Reset CSS--}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.0/destyle.min.css">

        {{--共通CSS--}}
        <link rel="stylesheet" href="{{ asset('css/commons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/commons/base.css') }}">
        <link rel="stylesheet" href="{{ asset('css/commons/component.css') }}">
        <link rel="stylesheet" href="{{ asset('css/commons/components/modals/confirmModal.css') }}">

        {{--各ページのCSSを読み込み--}}
        @stack('css')

        {{--JQuery--}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

        {{--共通JavaScript--}}
        <script src="{{ asset('js/commons/consts/editMode.js') }}"></script>
        <script src="{{ asset('js/commons/consts/userType.js') }}"></script>
        <script src="{{ asset('js/commons/consts/userAccountType.js') }}"></script>
        <script src="{{ asset('js/commons/utils/arrayUtil.js') }}"></script>
        <script src="{{ asset('js/commons/utils/dateTimeUtil.js') }}"></script>
        <script src="{{ asset('js/commons/utils/fileUtil.js') }}"></script>
        <script src="{{ asset('js/commons/utils/stringUtil.js') }}"></script>
        <script src="{{ asset('js/commons/base.js') }}"></script>
        <script src="{{ asset('js/commons/components/containers/lineOfficialAccountContainer.js') }}"></script>
        <script src="{{ asset('js/commons/components/messages/errorMessage.js') }}"></script>
        <script src="{{ asset('js/commons/components/modals/confirmModal.js') }}"></script>
        <script src="{{ asset('js/commons/components/selectBoxs/selectBox.js') }}"></script>
        <script src="{{ asset('js/apis/fetchApi.js') }}"></script>
        <script src="{{ asset('js/apis/lineMessagingApi.js') }}"></script>

        {{--各ページのJavaScript：固有を読み込み--}}
        @stack('js')

    </head>

    <body class="base">
        {{--非表示領域--}}
        <div class="hideContainer">
            <input type="text" id="txtUserType" value="{{ Auth::user()->user_type_id }}">
            <input type="text" id="txtUserAccountType" value="{{ Auth::user()->user_account_type_id }}">
        </div>

        {{--ヘッダー--}}
        <header class="baseHeader">
            {{--システム名--}}
            <div class="systemName">System Name</div>
            <div class="container">
                <div class="loginUserContainer">
                    <img src="" alt="" class="circleImg small">
                    <div class="userName">{{ Auth::user()->name }}</div>
                </div>
            </div>
        </header>

        <div class="baseContainer">
            {{--サイドメニュー--}}
            <aside class="baseSideContainer">
                {{--公式LINEアカウント--}}
                <div class="lineOfficialAccountContainer">
                    <header>LINE</header>
                    <div class="container">
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <img id="imgOfficialAccountPictureUrl" src="">
                            </div>
                        </div>
                        <div class="infoContainer">
                            <table class="infoTable">
                                <tbody>
                                    <tr>
                                        <th>LINE ID</th>
                                        <td id="tdLineOfficialAccountBasicId"></td>
                                    </tr>
                                    <tr>
                                        <th>アカウント名</th>
                                        <td id="tdLineOfficialAccountDisplayName"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{--サイドメニュー--}}
                <ul class="sideMenu">
                    <li class="parent"><a href="{{ route('top.index') }}">Top</a></li>
                    <li class="parent"><a href="{{ url('/') }}">LINE</a></li>
                    <li class="child"><a href="{{ route('line.oneToOne') }}">１対１トーク</a></li>
                    <li class="child"><a href="{{ url('/') }}">グループトーク</a></li>
                    <li class="child"><a href="{{ url('/') }}">ユーザー</a></li>
                    <li class="parent"><a href="{{ url('/') }}">マスタメンテナンス</a></li>
                    <li class="parent"><a href="{{ url('/') }}">設定</a></li>
                    <li class="child"><a href="{{ route('user.index') }}">担当者設定</a></li>
                    @if (\AppFacade::loginUserIsOperator())
                        <li class="child"><a href="{{ route('serviceProvider.index') }}">サービス提供者設定</a></li>
                    @endif
                </ul>
            </aside>

            {{--ページ--}}
            <main class="basePageContainer">
                {{--パンくずリスト--}}
                <ul class="breadcrumbTrail">
                    <li><a href="">Top</a></li>
                    <li><a href="">Menu1</a></li>
                    <li><a href="">Menu2</a></li>
                    <li><a href="">Menu3</a></li>
                </ul>
                
                {{--ページコンテンツ--}}
                <div class="basePageContent">
                    {{--各ページのコンテンツを表示--}}
                    @yield('page')
                </div>
            </main>
        </div>
    </body>
</html>