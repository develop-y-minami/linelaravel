<!DOCTYPE html>

<html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{--タイトル--}}
        <title>ログイン</title>

        {{--Reset CSS--}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.0/destyle.min.css">

        {{--CSS--}}
        <link rel="stylesheet" href="{{ asset('css/commons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/commons/component.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">

    </head>

    <body>
        <div class="loginContainer">
            {{--システム名--}}
            <div class="systemName">System Name</div>

            {{--ログインフォーム--}}
            <form method="POST" action="/login">
                @csrf

                <div>
                    <div>サービス提供者ID</div>
                    <input type="text" class="large" name="serviceProviderId" value="{{ old('serviceProviderId') }}" placeholder="サービス提供者IDを入力">
                </div>

                <div>
                    <div>アカウントID</div>
                    <input type="text" class="large" name="accountId" value="{{ old('accountId') }}" placeholder="アカウントIDを入力">
                </div>

                <div>
                    <div>パスワード</div>
                    <input type="password" class="large" name="password" value="{{ old('serviceProviderId') }}" placeholder="パスワードを入力">
                </div>

                {{--エラーメッセージ--}}
                @if ($errors->any())
                    <div class="errorMessage">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{--ログインボタン--}}
                <button class="blue large">ログイン</button>
            </form>
        </div>
    </body>
</html>