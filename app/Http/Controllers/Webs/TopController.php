<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * TopController
 * 
 */
class TopController extends Controller
{
    /**
     * __construct
     * 
     */
    public function __construct() {}

    /**
     * トップページ
     * HTTP Method Get
     * https://{host}
     * 
     * @param Request request リクエスト
     */
    public function index(Request $request) {
        try {
            return view('pages.top');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
