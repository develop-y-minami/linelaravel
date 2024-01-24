<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineMessageText
 * 
 * LINEメッセージテキスト情報
 * 
 */
class LineMessageText extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'line_message_id',
        'text'
    ];
}
