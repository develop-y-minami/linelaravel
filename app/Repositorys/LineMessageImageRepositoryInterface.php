<?php

namespace App\Repositorys;

/**
 * LineMessageImageRepositoryInterface
 * 
 */
interface LineMessageImageRepositoryInterface
{
    /**
     * LINEメッセージ画像情報を取得
     * 
     * @param string imageSetId image_set_id
     * @return Collection LINEメッセージ画像情報
     */
    public function findByImageSetId($imageSetId);
    
    /**
     * LINEメッセージ画像情報を登録
     * 
     * @param int    lineMessageId                     LINEメッセージ情報ID
     * @param string contentProviderType               画像ファイルの提供元
     * @param string contentProviderOriginalContentUrl 画像ファイルのURL
     * @param string contentProviderPreviewImageUrl    プレビュー画像のURL
     * @param string imageSetId                        画像セットID
     * @param int    imageSetIndex                     同時に送信した画像セットの中で、何番目の画像かを示す
     * @param int    imageSetTotal                     同時に送信した画像の総数
     * @param string filePath                          画像ファイルパス
     * @return LineMessageImage LINEメッセージ画像情報
     */
    public function create(
        $lineMessageId,
        $contentProviderType,
        $contentProviderOriginalContentUrl,
        $contentProviderPreviewImageUrl,
        $imageSetId,
        $imageSetIndex,
        $imageSetTotal,
        $filePath
    );
}