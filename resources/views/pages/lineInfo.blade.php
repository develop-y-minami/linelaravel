{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'LINE情報')

{{--CSS--}}
@push('css')
    {{--LINE情報ページCSS--}}
    <link rel="stylesheet" href="{{ asset('css/commons/components/lineContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons/components/lineUserContainer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/lineInfo.css') }}">
@endpush

{{--JavaScript--}}
@push('js')
    <script src="{{ asset('js/apis/lineApi.js') }}"></script>
    <script src="{{ asset('js/pages/lineInfo.js') }}"></script>
@endpush

{{--表示コンテンツ：LINE情報ページ--}}
@section('page')
    <div class="lineInfoPageContainer">
        <div class="splitContainer">
            {{--左コンテナー--}}
            <div class="leftContainer container">
                {{--LINE担当者情報--}}
                <header>
                    <div class="caption">担当者：{{ $data->line->user->name }}</div>
                    <button class="blue">担当者設定</button>
                </header>
                <main class="lineInfoContainer">
                    {{--LINE情報コンテナー--}}
                    <x-containers.line :line='$data->line'></x-containers.line>
                    {{--LINEユーザー情報コンテナー--}}
                    <x-containers.lineUser :lineUser='$data->line->lineUser'></x-containers.lineUser>
                </main>
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