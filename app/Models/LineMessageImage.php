<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineMessageImage
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
        'content_provider_type',
        'content_provider_original_content_url',
        'content_provider_preview_image_url',
        'image_set_id',
        'image_set_index',
        'image_set_total',
        'file_path'
    ];
}
