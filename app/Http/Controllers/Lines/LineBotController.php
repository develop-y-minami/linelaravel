<?php

namespace App\Http\Controllers\Lines;

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
        return 200;
    }
}
