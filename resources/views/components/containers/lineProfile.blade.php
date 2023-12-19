{{--LINEプロフィール情報コンテナー--}}
<div id="{{ $id }}" class="lineProfileContainer" {{ $class }}>
    {{--非表示領域--}}
    <div class="hideContainer">
        <input type="text" id="{{ $id }}TxtLineId" value="{{ $lineId }}">
    </div>
    {{--LINEプロフィール画像--}}
    <div class="circleImgContainer">
        <div class="imgBox">
            <img id="{{ $id }}ImgPictureUrl" src="{{ $pictureUrl }}" alt="">
        </div>
    </div>
    {{--LINEプロフィール情報--}}
    <div class="tableContainer">
        <table class="infoTable">
            <tbody>
                <tr>
                    <th>区分</th>
                    <td id="{{ $id }}TdLineAccountTypeName">{{ $lineAccountType->name }}</td>
                </tr>
                <tr>
                    <th>{{ $lineAccountType->id == \LineAccountType::GROUP ? 'グループ名' : '名前' }}</th>
                    <td id="{{ $id }}TdDisplayName">{{ $displayName }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>