<!DOCTYPE html>

<html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{--タイトル--}}
        <title>@yield('title')</title>

        {{--Reset CSS--}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.0/destyle.min.css">

        {{--共通CSS--}}
        <link rel="stylesheet" href="{{ asset('css/commons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/commons/base.css') }}">
        <link rel="stylesheet" href="{{ asset('css/commons/component.css') }}">

        {{--各ページのCSSを読み込み--}}
        @stack('css')

        {{--JQuery--}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

        {{--共通JavaScript--}}
        <script src="{{ asset('js/commons/consts/const.js') }}"></script>
        <script src="{{ asset('js/commons/base.js') }}"></script>
        <script src="{{ asset('js/commons/components/lineOfficialAccountContainer.js') }}"></script>
        <script src="{{ asset('js/apis/fetchApi.js') }}"></script>
        <script src="{{ asset('js/apis/lineApi.js') }}"></script>

        {{--各ページのJavaScript：固有を読み込み--}}
        @stack('js')

    </head>

    <body class="base">
        {{--ヘッダー--}}
        <header class="baseHeader">
            {{--システム名--}}
            <div class="systemName">System Name</div>
            <div class="container">
                <div class="user-container">

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
                        <div class="imgContainer">
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
                <div class="sideMenuContainer">
                    <ul class="menuGroup">
                        <li class="menu parent">Top</li>
                    </ul>
                    <ul class="menuGroup">
                        <li class="menu parent">設定</li>
                        <li class="menu child">マスタ設定</li>
                        <li class="menu child">担当者設定</li>
                        <li class="menu child">システム設定</li>
                    </ul>
                </div>
            </aside>

            {{--ページ--}}
            <main class="basePageContainer">
                {{--ページヘッダー--}}
                <header class="basePageHeader">
                    {{--パンくずリスト--}}
                    <div class="breadcrumbTrail">
                        <div class="link">Top</div>
                        <div class="link">Menu1</div>
                        <div class="link">Menu2</div>
                        <div class="link">Menu3</div>
                    </div>
                </header>
                
                {{--ページコンテンツ--}}
                <div class="basePageContent">
                    {{--各ページのコンテンツを表示--}}
                    @yield('page')
                </div>
            </main>
        </div>
    </body>
</html>