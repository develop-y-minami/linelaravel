{{--LINEプロフィール情報コンテナー--}}
<div id="{{ $id }}" class="lineProfileContainer" {{ $class }}>
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