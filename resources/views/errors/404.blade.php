{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'ページが見つかりません')

{{--CSS--}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/errors/404.css') }}">
@endpush

{{--表示コンテンツ：404ページ--}}
@section('page')
    <div class="errorPageContainer">
        <div class="messageContainer">
            <div class="caption">お探しのページが見つかりませんでした</div>
            <ul>
                <li>以下を確認してください</li>
                <li>URLに誤りがある</li>
                <li>データが削除されている</li>
            </ul>
        </div>
        <div class="imgContainer">
            <img src="{{ asset('img/errors/404.jpg') }}" alt="">
        </div>
        <div><a href="https://jp.freepik.com/free-vector/oops-404-error-with-a-broken-robot-concept-illustration_8030430.htm#query=error%20404&position=3&from_view=keyword&track=ais&uuid=fa884d1a-6f07-41dc-93e0-e915b928494f">著作者：storyset</a>／出典：Freepik</div>
    </div>
@endsection