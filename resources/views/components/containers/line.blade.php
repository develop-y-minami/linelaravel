{{--LINE情報コンテナー--}}
<div id='{{ $id }}' class="lineContainer {{ $class }}">
    <header>
        <div class="caption">LINE</div>
        <div class="rightContainer">
            @php $labelBox = ''; @endphp
            @switch($line->lineAccountStatus->id)
                @case(\LineAccountStatus::FOLLOW)
                @case(\LineAccountStatus::JOIN)
                    @php $labelBox = 'green'; @endphp
                    @break
                @case(\LineAccountStatus::UNFOLLOW)
                @case(\LineAccountStatus::LEAVE)
                    @php $labelBox = 'red'; @endphp
                    @break
                @default
            @endswitch
            <div id="{{ $lineAccountStatusLabelBoxId }}" class="labelBox {{ $labelBox }}">{{ $line->lineAccountStatus->name }}</div>
        </div>  
    </header>
    <main>
        <div class="buttonContainer">
            <button id="{{ $btnLineLatestUpdateId }}" class="green">LINEから最新情報を取得する</button>
        </div>
        {{--LINEプロフィール情報コンテナー--}}
        <x-containers.lineProfile
            :id='$lineProfileContainerId'
            :class='$lineProfileContainerClass'
            :imgPictureUrlId='$imgPictureUrlId'
            :tdDisplayNameId='$tdDisplayNameId'
            :tdLineAccountTypeNameId='$tdLineAccountTypeNameId'
            :line='$line'
        ></x-containers.lineProfile>
    </main>
</div>