<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LineAccountStatusServiceInterface;
use App\Services\UserServiceInterface;
use App\Objects\LineOneToOnePage;

/**
 * LineController
 * 
 */
class LineController extends Controller
{
    /**
     * LineAccountStatusServiceInterface
     * 
     */
    private $lineAccountStatusService;
    /**
     * UserServiceInterface
     * 
     */
    private $userService;

    /**
     * __construct
     * 
     * @param LineAccountStatusServiceInterface lineAccountStatusService
     * @param UserServiceInterface              userService
     */
    public function __construct(
        LineAccountStatusServiceInterface $lineAccountStatusService,
        UserServiceInterface $userService
    )
    {
        $this->lineAccountStatusService = $lineAccountStatusService;
        $this->userService = $userService;
    }

    /**
     * １対１トークページ
     * HTTP Method Get
     * https://{host}/line/one-to-one
     * 
     * @param Request request リクエスト
     */
    public function oneToOne(Request $request) {
        try
        {
            // LINEアカウント状態セレクトボックス設定データを取得
            $lineAccountStatusSelectItems = $this->lineAccountStatusService->getSelectItems(\LineAccountType::ONE_TO_ONE);
            // 担当者セレクトボックス設定データを取得
            $userSelectItems = $this->userService->getSelectItems();

            // 返却データに設定
            $result = new LineOneToOnePage(\LineAccountType::ONE_TO_ONE, $lineAccountStatusSelectItems, $userSelectItems);

            return view('pages.lineOneToOne')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
