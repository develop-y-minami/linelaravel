{{--LINEユーザー情報コンテナー--}}
<div class="lineUserContainer">
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
                        <th>名前</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>区分</th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($lineUser->id > 0)
            <div class="buttonContainer">
                <button class="blue">修正</button>
                <button class="red">削除</button>
            </div>
        @endif
    </main>
</div>