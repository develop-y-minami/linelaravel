<?php

namespace App\Services\Apis;

use GuzzleHttp\Client;

/**
 * LineLoginApiService
 * 
 */
class LineLoginApiService implements LineLoginApiServiceInterface
{
    /**
     * LINEログインAPI URL
     * https://api.line.me/v2
     * 
     */
    private $loginApiUrl;
    /**
     * LINEログインAPI URL
     * https://api.line.me/oauth2/v2.1
     * 
     */
    private $loginApiOauthUrl;

    /**
     * __construct
     * 
     */
    public function __construct()
    {
        $this->loginApiUrl = config('line.login_api_url');
        $this->loginApiOauthUrl = config('line.login_api_oauth_url');
    }

    /**
     * アクセストークンを検証
     * 
     * @param string accessToken アクセストークン
     * @return bool 検証結果
     */
    public function verify($accessToken)
    {
        try
        {
            // リクエストに設定するデータを設定
            $baseUrl = ['base_uri' => $this->loginApiOauthUrl];
            $method = 'GET';
            $path = 'verify?access_token='.$accessToken;

            // 結果を取得
            $result = $this->sendRequest($baseUrl, $method, $path);

            if ($result->client_id == config('line.liff_channel_id'))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * リクエストを送信
     * 
     * @param array  baseUrl    リクエストURL
     * @param string method     HTTP Method
     * @param string path       エンドポイントURL
     * @param array  headers    HTTP Header
     * @param array  formParams フォームパラメータ
     */
    private function sendRequest($baseUrl, $method, $path, $headers = [], $formParams = null)
    {
        // レスポンスデータ
        $response;

        try
        {
            // クライアントを生成
            $client = new Client($baseUrl);

            if ($formParams)
            {
                $response = $client->request($method, $path, $formParams, $headers);
            }
            else
            {
                $response = $client->request($method, $path, $headers);
            }
        }
        catch (\Exception $e)
        {
            throw $e;
        }

        // レスポンスデータをJson形式で返却
        return json_decode($response->getbody()->getcontents());
    }
}