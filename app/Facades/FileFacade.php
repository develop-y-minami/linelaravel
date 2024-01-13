<?php

namespace App\Facades;

/**
 * FileFacade
 */
class FileFacade
{
    /**
     * base64形式の画像ファイルから拡張子を取得
     * 
     * @param string imageData 画像ファイルデータ
     * @return string 拡張子
     */
    public static function getExtensionBase64ImageFile($imageData)
    {
        preg_match('/data:image\/(\w+);base64,/', $imageData, $matches);
        $extension = $matches[1];
        return $extension;
    }

    /**
     * base64形式の画像ファイルをdecode
     * 
     * @param string imageData 画像ファイルデータ
     * @return string 画像ファイル
     */
    public static function decodeBase64ImageFile($imageData)
    {
        $img = preg_replace('/^data:image.*base64,/', '', $imageData);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        return $fileData;
    }
}