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
            <button id="{{ $btnLatestLineInforId }}" class="green">LINEから最新情報を取得する</button>
        </div>
        <div class="profileContainer">
            {{--LINEプロフィール画像--}}
            <div class="circleImgContainer">
                <div class="imgBox">
                    <img id="{{ $imgPictureUrlId }}" src="{{ $line->picture_url }}" alt="">
                </div>
            </div>
            {{--LINEプロフィール情報--}}
            <div class="tableContainer">
                <table class="infoTable">
                    <tbody>
                        <tr>
                            <th>区分</th>
                            <td id="{{ $tdLineAccountTypeNameId }}">{{ $line->lineAccountType->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ $line->lineAccountType->id == \LineAccountType::GROUP ? 'グループ名' : '名前' }}</th>
                            <td id="{{ $tdDisplayNameId }}">{{ $line->display_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>