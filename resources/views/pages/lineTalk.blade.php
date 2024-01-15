{{--baseGridレイアウトを継承--}}
@extends('layouts.baseGrid')

{{--タイトルを設定--}}
@section('title', 'LINEトーク')

{{--CSS--}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/pages/lineTalk.css') }}">
@endpush

{{--表示コンテンツ：LINEトークページ--}}
@section('page')
    <div class="lineTalkPageContainer">
        <div class="lineContainer">
            {{--サービス提供者情報--}}
            <div class="container itemBox serviceProviderContainer">
                <div class="labelBox green">有効</div>
                <div class="itemName">サービス提供者</div>
                <a href="">aaaaaaaaaaa</a>
            </div>

            {{--LINEプロフィール情報コンテナー--}}
            <div class="container lineProfileContainer">
                <div class="itemBox">
                    <div class="labelBox green">友達</div>
                    <div class="itemName">LINE</div>
                </div>

                <div class="profileContainer">
                    {{--LINEプロフィール画像--}}
                    <div class="circleImgContainer">
                        <div class="imgBox">
                            <a href=""><img src=""></a>
                        </div>
                    </div>
                    {{--LINEプロフィール情報--}}
                    <div class="infoContainer">
                        <div class="profile">
                            <div class="row">
                                <div class="itemName">トークタイプ</div>
                                <div class="data">１対１</div>
                            </div>
                            <div class="row">
                                <div class="itemName">表示名</div>
                                <div class="data">南　勇気</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container lineMemberContainer">
                <div class="itemName">LINEメンバー</div>
                <div class="memberContainer">
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                    <div class="profileContainer">
                        {{--LINEプロフィール画像--}}
                        <div class="circleImgContainer">
                            <div class="imgBox">
                                <a href=""><img src=""></a>
                            </div>
                        </div>
                        {{--LINEプロフィール情報--}}
                        <div class="infoContainer">
                            <div class="profile">
                                <div class="itemName">南　勇気</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--LINEトーク--}}
        <div class="lineTalkContainer">
            <header class="container">
                <div class="itemName">LINEトーク</div>
            </header>
            <div class="container talkContainer">
                <header>
                    <x-selects.lineTalkHistoryTerm></x-selects.lineTalkHistoryTerm>
                    <x-buttons.reload></x-buttons.reload>
                </header>
                <main class="lineDisplay">
                    <div class="talk">
                        <div class="row"><div class="labelContainer"><div class="caption">17時09分38秒</div><div class="label green">友達追加</div></div></div>
                        <div class="row"><div class="labelContainer"><div class="caption">17時10分55秒</div><div class="label red">ブロック</div></div></div>
                        <div class="row"><div class="messageContainer from"><div class="caption"><div>公式LINE</div><div>17時09分39秒</div></div><div class="messageBox"><div class="message">はじめまして南優毅さん！<br>友達追加ありがとうございます！</div></div></div></div>
                    </div>
                    <div class="">
                        <textarea class="w-100p" rows="6" placeholder="メッセージを入力"></textarea>
                    </div>
                </main>
                <footer>
                    <button class="blue large w-100p">送信</button>
                </footer>
            </div>
        </div>

        <aside class="rightSubMenu">
            <ul class="subMenu">
                <li><div class="menu">メッセージテンプレート送信</div></li>
                <li><a href="" class="menu">LINEトーク履歴ページへ</a></li>
            </ul>
        </aside>
    </div>
@endsection