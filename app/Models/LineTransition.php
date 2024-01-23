<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineTransition
 * 
 */
class LineTransition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'transition_date',
        'service_provider_id',
        'user_id',
        'valid_count',
        'increase',
        'decrease',
    ];
}
