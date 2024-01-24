<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineMessageImage
 * 
 * LINEメッセージ画像情報
 * 
 */
class LineMessageImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'line_message_id',
        'line_channel_content_provider_type',
        'line_channel_content_provider_original_content_url',
        'line_channel_content_provider_preview_image_url',
        'line_channel_image_set_id',
        'line_channel_image_set_index',
        'line_channel_image_set_total',
        'file_path'
    ];
}
