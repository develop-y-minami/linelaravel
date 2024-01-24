<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ServiceProvider
 * 
 * サービス提供者情報
 * 
 */
class ServiceProvider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'provider_id',
        'name',
        'use_start_date',
        'use_end_date',
        'use_stop_flg'
    ];
}
