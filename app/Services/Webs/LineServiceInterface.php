<?php

namespace App\Services\Webs;

/**
 * LineServiceInterface
 * 
 */
interface LineServiceInterface
{
    /**
     * LINE情報を取得
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function getLine($id);
}