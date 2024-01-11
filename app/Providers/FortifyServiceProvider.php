<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Carbon\Carbon;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Fortify::createUsersUsing(CreateNewUser::class);
        //Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        //Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        //Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView(function () { return view('pages.login'); });
        /**
         * ログイン処理
         * 
         */
        Fortify::authenticateUsing(function (Request $request)
        {
            // パラメータ取得
            $serviceProviderId = $request->input('serviceProviderId');
            $accountId = $request->input('accountId');
            $password = $request->input('password');

            if ($serviceProviderId != null)
            {
                // サービス提供者情報を取得
                $serviceProvider = \App\Models\ServiceProvider::whereProviderId($serviceProviderId)->first();
                if ($serviceProvider != null)
                {
                    if ($serviceProvider->use_stop == true)
                    {
                        // サービス利用停止
                        throw ValidationException::withMessages(['serviceProviderId' => 'サービスの利用が停止されています']);
                    }

                    if ($serviceProvider->use_end_date_time != null)
                    {
                        // 現在日付を取得
                        $today = Carbon::today();
                        // サービス利用終了日を取得
                        $useEndDateTime = new Carbon($serviceProvider->use_end_date_time);
                        // サービス利用期間が終了しているか判定
                        if ($today->lt($useEndDateTime) == false)
                        {
                            throw ValidationException::withMessages(['serviceProviderId' => 'サービス利用期間が終了しました']);
                        }
                    }

                    // ユーザー情報を取得
                    $user = \App\Models\User::whereServiceProviderId($serviceProvider->id)->whereAccountId($accountId)->first();
                    if ($user != null && Hash::check($password, $user->password))
                    {
                        // 認証成功
                        return $user;
                    }    
                }
            }
            else
            {
                // ユーザー情報を取得
                $user = \App\Models\User::whereAccountId($accountId)->first();
                if ($user != null && Hash::check($password, $user->password))
                {
                    // 認証成功
                    return $user;
                }
            }
            return false;
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
