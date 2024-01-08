<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    /**
     * サービス提供者ページ
     * HTTP Method Get
     * https://{host}/serviceProvider
     * 
     * @param Request request リクエスト
     * @return View
     */
    public function index(Request $request)
    {
        try
        {
            return view('pages.serviceProvider');
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
