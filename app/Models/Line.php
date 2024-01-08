<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Line
 * 
 */
class Line extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToLineAccountStatus;
    use \App\Traits\Relations\BelongsToLineAccountType;
    use \App\Traits\Relations\BelongsToServiceProvider;
    use \App\Traits\Relations\BelongsToUser;
    use \App\Traits\Relations\HasOneLineUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'display_name',
        'picture_url',
        'line_account_type_id',
        'line_account_status_id',
        'user_id',
    ];
}
