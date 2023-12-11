<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineMessageText
 * 
 */
class LineMessageText extends Model
{
    use HasFactory;

    /**
     * 登録/更新を許可するカラム
     *
     */
    protected $fillable = [
        'line_message_id',
        'text'
    ];
}
