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
        <link rel="stylesheet" href="{{ asset('css/commons/component.css') }}">
        <link rel="stylesheet" href="{{ asset('css/liffs/commons/base.css') }}">

        {{--各ページのCSSを読み込み--}}
        @stack('css')

        {{--LIFF SDK--}}
        <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>

        {{--JQuery--}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

        {{--共通JS--}}
        <script src="{{ asset('js/commons/components/messages/errorMessage.js') }}"></script>
        <script src="{{ asset('js/apis/fetchApi.js') }}"></script>
        <script src="{{ asset('js/apis/liffApi.js') }}"></script>
        <script src="{{ asset('js/liffs/liff.js') }}"></script>

        {{--各ページのJavaScript：固有を読み込み--}}
        @stack('js')
        
    </head>

    <body class="base">
        @yield('page')

        <div id="loadingOverlay" class="overlay">
            <div class="loading"></div>
        </div>
    </body>
</html>