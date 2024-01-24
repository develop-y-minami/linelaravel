<?php

namespace App\Repositorys;

/**
 * LineMessageImageRepositoryInterface
 * 
 * LINEメッセージ画像情報
 * 
 */
interface LineMessageImageRepositoryInterface
{
    /**
     * 画像セットID検索
     * 
     * @param string lineChannelImageSetId 画像セットID
     * @return Collection LINEメッセージ画像情報
     */
    public function findByLineChannelImageSetId($lineChannelImageSetId);
    
    /**
     * 登録
     * 
     * @param int    lineMessageId                                LINEメッセージ情報ID
     * @param string lineChannelContentProviderType               画像ファイル提供元
     * @param string lineChannelContentProviderOriginalContentUrl 画像ファイルURL
     * @param string lineChannelContentProviderPreviewImageUrl    プレビュー画像ファイルURL
     * @param string lineChannelImageSetId                        画像セットID
     * @param int    lineChannelImageSetIndex                     画像番号
     * @param int    lineChannelImageSetTotal                     画像数
     * @param string filePath                                     画像ファイルパス
     * @return LineMessageImage LINEメッセージ画像情報
     */
    public function register(
        $lineMessageId,
        $lineChannelContentProviderType,
        $lineChannelContentProviderOriginalContentUrl,
        $lineChannelContentProviderPreviewImageUrl,
        $lineChannelImageSetId,
        $lineChannelImageSetIndex,
        $lineChannelImageSetTotal,
        $filePath
    );
}