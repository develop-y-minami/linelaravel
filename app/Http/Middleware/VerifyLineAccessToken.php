<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * VerifyLineAccessToken
 * LINEログインAPIでアクセストークンの検証を行う
 * 
 */
class VerifyLineAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bearerトークンを取得
        $accessToken = $request->bearerToken();

        // LineLoginApiServiceのインスタンスを生成
        $lineLoginApiService = new \App\Services\Apis\LineLoginApiService();

        // アクセストークンを検証
        $result = $lineLoginApiService->verify($accessToken);

        if ($result == true)
        {
            return $next($request);
        }
        else
        {
            abort(404);
        }
    }
}
