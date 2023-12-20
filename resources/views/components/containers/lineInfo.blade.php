{{--LINE情報コンテナー--}}
<div id="{{ $id }}" class="lineInfoContainer {{ $class }}">
    {{--LINE担当者情報--}}
    <header>
        <div class="caption">担当者：<span id="{{ $id }}UserName">{{ $line->user->name }}</span></div>
        <button id="{{ $id }}BtnLineOfUserSetting" class="blue">担当者設定</button>
    </header>
    <main>
        {{--LINE情報コンテナー--}}
        <x-containers.line :line='$line'></x-containers.line>
        {{--LINEユーザー情報コンテナー--}}
        <x-containers.lineUser :lineUser='$line->lineUser'></x-containers.lineUser>
    </main>

    <div id="{{ $id }}Overlay" class="overlay">
        <div class="container">
            {{--LINE担当者設定モーダル--}}
            <x-modals.lineOfUserSetting
                :lineId='$line->id'
                :userSelectItems='$userSelectItems'
                :userSelectedValue='$line->user->id'
                :lineNoticeTypeCheckListItems='$lineNoticeTypeCheckListItems'
                :lineOfUserNotice='$line->line_of_user_notice'
            ></x-modals.lineOfUserSetting>
            {{--LINE最新情報更新モーダル--}}
            <x-modals.lineLatestUpdate></x-modals.lineLatestUpdate>
        </div>
    </div>
</div>