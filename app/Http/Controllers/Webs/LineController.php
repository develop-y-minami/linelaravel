<?php

namespace App\Http\Controllers\Webs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Webs\LineAccountStatusServiceInterface;
use App\Services\Webs\LineNoticeTypeServiceInterface;
use App\Services\Webs\LineServiceInterface;
use App\Services\Webs\UserServiceInterface;
use App\Services\Webs\ServiceProviderServiceInterface;
use App\Objects\Pages\LineInfoPage;
use App\Objects\Pages\LineOneToOnePage;

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
     * LineNoticeTypeServiceInterface
     * 
     */
    private $lineNoticeTypeService;
    /**
     * LineServiceInterface
     * 
     */
    private $lineService;
    /**
     * ServiceProviderService
     * 
     */
    private $serviceProviderService;
    /**
     * UserServiceInterface
     * 
     */
    private $userService;

    /**
     * __construct
     * 
     * @param LineAccountStatusServiceInterface lineAccountStatusService
     * @param LineNoticeTypeServiceInterface    lineNoticeTypeService
     * @param LineServiceInterface              lineService
     * @param ServiceProviderServiceInterface   serviceProviderService
     * @param UserServiceInterface              userService
     */
    public function __construct(
        LineAccountStatusServiceInterface $lineAccountStatusService,
        LineNoticeTypeServiceInterface $lineNoticeTypeService,
        LineServiceInterface $lineService,
        ServiceProviderServiceInterface $serviceProviderService,
        UserServiceInterface $userService
    )
    {
        $this->lineAccountStatusService = $lineAccountStatusService;
        $this->lineNoticeTypeService = $lineNoticeTypeService;
        $this->lineService = $lineService;
        $this->serviceProviderService = $serviceProviderService;
        $this->userService = $userService;
    }

    /**
     * １対１トークページ
     * HTTP Method Get
     * https://{host}/line/one-to-one
     * 
     * @param Request request リクエスト
     * @return View
     */
    public function oneToOne(Request $request) {
        try
        {
            // LINEアカウント状態セレクトボックス設定データを取得
            $lineAccountStatusSelectItems = $this->lineAccountStatusService->getSelectItems(\LineAccountType::ONE_TO_ONE);
            // サービス提供者セレクトボックス設定データを取得
            $serviceProviderSelectItems = $this->serviceProviderService->getSelectItems();
            // 担当者セレクトボックス設定データを取得
            $userSelectItems = $this->userService->getSelectItems();

            // 返却データに設定
            $result = new LineOneToOnePage(\LineAccountType::ONE_TO_ONE, $lineAccountStatusSelectItems, $serviceProviderSelectItems, $userSelectItems);

            return view('pages.lineOneToOne')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * LINE情報ページ
     * HTTP Method Get
     * https://{host}/line/info/{id}
     * 
     * @param Request request リクエスト
     * @param string  id      ID
     * @return View
     */
    public function info(Request $request, $id) {
        try
        {
            // LINE情報を取得
            $line = $this->lineService->getLine((int)$id);
            // 担当者セレクトボックス設定データを取得
            $userSelectItems = $this->userService->getSelectItems();
            // LINE通知種別チェックリスト設定データを取得
            $lineNoticeTypeCheckListItems = $this->lineNoticeTypeService->getCheckListItems((int)$id);

            // 返却データに設定
            $result = new LineInfoPage($line, $userSelectItems, $lineNoticeTypeCheckListItems);

            return view('pages.lineInfo')->with('data', $result);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
