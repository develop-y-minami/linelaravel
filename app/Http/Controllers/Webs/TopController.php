<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserServiceInterface;
use App\Objects\TopPage;

/**
 * TopController
 * 
 */
class TopController extends Controller
{
    /**
     * UserServiceInterface
     * 
     */
    private $userService;

    /**
     * __construct
     * 
     * @param UserServiceInterface userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * トップページ
     * HTTP Method Get
     * https://{host}
     * 
     * @param Request request リクエスト
     */
    public function index(Request $request) {
        try
        {
            // 担当者セレクトボックス設定データを取得
            $userSelectItems = $this->userService->getSelectItems();

            // 返却データに設定
            $result = new TopPage($userSelectItems);

            return view('pages.top')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
