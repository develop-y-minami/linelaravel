<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\Hash;
use App\Models\LineMessageImage;

/**
 * LineMessageImageRepository
 * 
 */
class LineMessageImageRepository implements LineMessageImageRepositoryInterface
{
    /**
     * LINEメッセージ情報を登録
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
    )
    {
        return LineMessageImage::create([
            'line_message_id' => $lineMessageId,
            'content_provider_type' => $contentProviderType,
            'content_provider_original_content_url' => $contentProviderOriginalContentUrl,
            'content_provider_preview_image_url' => $contentProviderPreviewImageUrl,
            'image_set_id' => $imageSetId,
            'image_set_index' => $imageSetIndex,
            'image_set_total' => $imageSetTotal,
            'file_path' => $filePath
        ]);
    }
}