<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineMessageImage;

/**
 * LineMessageImageRepository
 * 
 * LINEメッセージ画像情報
 * 
 */
class LineMessageImageRepository implements LineMessageImageRepositoryInterface
{
    /**
     * 画像セットID検索
     * 
     * @param string lineChannelImageSetId 画像セットID
     * @return Collection LINEメッセージ画像情報
     */
    public function findByLineChannelImageSetId($lineChannelImageSetId)
    {
        return LineMessageImage::whereLineChannelImageSetId($lineChannelImageSetId)->orderBy('line_channel_image_set_id')->get();
    }

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
    )
    {
        return LineMessageImage::create([
            'line_message_id' => $lineMessageId,
            'line_channel_content_provider_type' => $lineChannelContentProviderType,
            'line_channel_content_provider_original_content_url' => $lineChannelContentProviderOriginalContentUrl,
            'line_channel_content_provider_preview_image_url' => $lineChannelContentProviderPreviewImageUrl,
            'line_channel_image_set_id' => $lineChannelImageSetId,
            'line_channel_image_set_index' => $lineChannelImageSetIndex,
            'line_channel_image_set_total' => $lineChannelImageSetTotal,
            'file_path' => $filePath
        ]);
    }
}