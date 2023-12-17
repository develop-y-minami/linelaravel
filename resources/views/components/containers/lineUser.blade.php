{{--LINEユーザー情報コンテナー--}}
<div id="{{ $id }}" class="lineUserContainer {{ $class }}">
    <header>
        <div class="caption">ユーザー情報</div>
        <div class="rightContainer">
            @if ($lineUser->id == 0)
                <div class="labelBox">未登録</div>
            @else
                <div class="labelBox violet">登録済</div>
            @endif
        </div>  
    </header>
    <main class="mainContainer">
        {{--LINEユーザー情報--}}
        <div class="tableContainer">
            <table class="infoTable">
                <tbody>
                    <tr>
                        <th>ユーザーID</th>
                        <td><a href="">{{ $lineUser->application_id }}</a></td>
                    </tr>
                    <tr>
                        <th>区分</th>
                        <td>{{ $lineUser->Personality->name }}</td>
                    </tr>
                    <tr>
                        <th>名前</th>
                        <td>{{ $lineUser->name }}</td>
                    </tr>
                    <tr>
                        <th>名前（カナ）</th>
                        <td>{{ $lineUser->name_kana }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $lineUser->mail }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $lineUser->tel_number }}</td>
                    </tr>
                    <tr>
                        <th>FAX番号</th>
                        <td>{{ $lineUser->fax_number }}</td>
                    </tr>
                    <tr>
                        <th>郵便番号</th>
                        <td>{{ $lineUser->post }}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{{ \StringFacade::getAddress($lineUser->prefecture->name, $lineUser->municipalitie, $lineUser->house_number, $lineUser->building) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>