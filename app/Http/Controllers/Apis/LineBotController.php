<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * LineBotController
 * 
 */
class LineBotController extends Controller
{
    /**
     * __construct
     * 
     */
    public function __construct()
    {

    }
    
    /**
     * Line Webhook
     * HTTP Method Post
     * https://{host}/line/webhook
     * 
     * @param Request request リクエスト
     */
    public function webhook(Request $request) {
        try
        {
            return 200;

            
            
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
