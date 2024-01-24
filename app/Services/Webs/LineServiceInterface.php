<?php

namespace App\Services\Webs;

/**
 * LineServiceInterface
 * 
 * LINE情報
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