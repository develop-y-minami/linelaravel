{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'LINE情報')

{{--CSS--}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/commons/components/modals/serviceProviderSettingModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/line.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/commons/components/modals/serviceProviderSettingModal.js') }}"></script>
    <script src="{{ asset('js/pages/line.js') }}"></script>
@endpush

{{--表示コンテンツ：LINE情報ページ--}}
@section('page')
    <div class="linePageContainer">
        <main>
            {{--サービス提供者情報--}}
            <div class="contentContainer itemBox">
                <div class="labelBox
                    {{ \AppViewFacade::serviceProviderUseStopFlgLabelBoxColor($data->line->serviceProvider->use_stop_flg) }}">
                    {{ \ServiceProviderUseStopFlg::getName($data->line->serviceProvider->use_stop_flg) }}
                </div>
                <div class="caption itemName">サービス提供者</div>
                <a href="{{ route('serviceProvider', ['id' => $data->line->serviceProvider->id]) }}">{{ $data->line->serviceProvider->name }}</a>
            </div>

            {{--LINE情報--}}
            <div class="contentContainer lineContainer">
                <div class="itemBox">
                    {{--LINEアカウント状態--}}
                    <div class="labelBox {{ \AppViewFacade::lineAccountStatusIdLabelBoxColor($data->line->lineAccountStatus->id) }}">{{ $data->line->lineAccountStatus->name }}</div>
                    <div class="caption itemName">LINE情報</div>
                </div>
                <div class="profileContainer">
                    {{--LINEプロフィール画像--}}
                    <div class="circleImgContainer">
                        <div class="imgBox">
                            <a href="{{ $data->line->picture_url }}"><img src="{{ $data->line->picture_url }}"></a>
                        </div>
                    </div>
                    {{--LINEプロフィール情報コンテナー--}}
                    <div class="infoContainer">
                        {{--LINEプロフィール情報--}}
                        <div class="profile">
                            <div class="row">
                                <div class="itemName">トークタイプ</div>
                                <div class="data">{{ $data->line->lineAccountType->name }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">表示名</div>
                                <div class="data">{{ $data->line->display_name }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">友達追加日</div>
                                <div class="data">{{ \ViewFacade::convertJpDateTime($data->line->created_at) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--LINE通知設定--}}
                <div class="noticeContainer">
                    <div class="itemBox">
                        <div class="caption itemName">通知設定</div>
                        <div class="checkBox">
                            <input type="checkbox" id="checkLineNoticeSetting" disabled {{ \ViewFacade::checked($data->line->notice_setting) }}>
                            <label for="checkLineNoticeSetting">通知する</label>
                        </div>
                    </div>
                    {{--LINE通知設定グリッド--}}
                    <x-grids.lineNoticeSettingCheck :checkItems='$data->lineNoticeSettingCheckItems'></x-grids.lineNoticeSettingCheck>
                </div>

                <div class="lineUserContainer">
                    <div class="itemBox">
                        @if ($data->line->lineUser->id == 0)
                            <div class="labelBox red">未登録</div>
                        @endif
                        <div class="caption itemName">ユーザー登録情報</div>
                    </div>
                    <div class="infoContainer">
                        <div class="lineUserInfo">
                            <div class="row">
                                <div class="itemName">アカウントID</div>
                                <div class="data">{{ $data->line->lineUser->account_id }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">人格</div>
                                <div class="data">{{ $data->line->lineUser->personality->name }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">名前</div>
                                <div class="data nameBox">
                                    <div class="kana">{{ $data->line->lineUser->name_kana }}</div>
                                    <div class="name">{{ $data->line->lineUser->name }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="itemName">メールアドレス</div>
                                <div class="data">{{ $data->line->lineUser->mail }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">電話番号</div>
                                <div class="data">{{ $data->line->lineUser->tel_number }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">FAX番号</div>
                                <div class="data">{{ $data->line->lineUser->fax_number }}</div>
                            </div>
                            <div class="row">
                                <div class="itemName">住所</div>
                                <div class="data address">
                                    <div class="post"><div>{{ $data->line->lineUser->post }}</div></div>
                                    <div class="address">{{ \AppViewFacade::address(
                                        $data->line->lineUser->prefecture->name,
                                        $data->line->lineUser->prefecture->municipalitie,
                                        $data->line->lineUser->prefecture->house_number,
                                        $data->line->lineUser->prefecture->building
                                    ) }}</div>
                                </div>
                            </div>
                            @if ($data->line->lineUser->id != 0)
                                @if ($data->line->lineUser->personality_id == \Personality::INDIVIDUAL)
                                    {{--個人の場合に表示--}}
                                    <div class="row">
                                        <div class="itemName">性別</div>
                                        <div class="data">{{ $data->line->lineUser->lineUserIndividual->gender->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="itemName">生年月日</div>
                                        <div class="data">{{ \ViewFacade::convertJpDate($data->line->lineUser->lineUserIndividual->birth_date) }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="itemName">年齢</div>
                                        <div class="data">{{ \ViewFacade::age($data->line->lineUser->lineUserIndividual->birth_date) }}</div>
                                    </div>  
                                @elseif ($data->line->lineUser->personality_id == \Personality::CORPORATE)
                                    
                                @endif
                            @endif
                            <div class="row">
                                <div class="itemName">登録日時</div>
                                <div class="data">{{ \ViewFacade::convertJpDateTime($data->line->lineUser->created_at) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contentContainer userContainer">
                <div class="itemBox">
                    <div class="caption itemName">担当者</div>
                    <a href="">{{ $data->line->user->name }}</a>
                </div>
                <div class="noticeContainer">
                    <div class="itemBox">
                        <div class="caption itemName">通知設定</div>
                        <div class="checkBox">
                            <input type="checkbox" id="checkLineNoticeUserSetting" disabled {{ \ViewFacade::checked($data->line->notice_user_setting) }}>
                            <label for="checkLineNoticeUserSetting">担当者に通知する</label>
                        </div>
                    </div>
                    {{--LINE通知担当者設定グリッド--}}
                    <x-grids.lineNoticeUserSettingCheck :checkItems='$data->lineNoticeUserSettingCheckItems'></x-grids.lineNoticeUserSettingCheck>
                </div>
            </div>
        </main>

        <aside class="rightSubMenu">
            <ul class="subMenu">
                <li><div id="serviceProviderSetting" class="menu">サービス提供者設定</div></li>
                <li><div class="menu">担当者設定</div></li>
                <li><div class="menu">担当者通知設定</div></li>
                <li><a href="{{ route('line.talk', [ 'id' => $data->line->id ]) }}" class="menu">LINEトークページへ</a></li>
            </ul>
        </aside>

        <div id="overlay" class="overlay">
            <div class="container">
                {{--サービス提供者設定モーダル--}}
                <x-modals.serviceProviderSetting
                    :serviceProviderSelectItems='$data->serviceProviderSelectItems'
                    :serviceProviderSelectedValue='$data->line->service_provider_id'>
                </x-modals.serviceProviderSetting>
            </div>
        </div>
    </div>
@endsection