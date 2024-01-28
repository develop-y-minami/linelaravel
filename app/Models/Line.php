<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Line
 * 
 * LINE情報
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
        'line_channel_user_id',
        'line_channel_group_id',
        'line_channel_display_name',
        'line_channel_picture_url',
        'line_account_type_id',
        'line_account_status_id',
        'service_provider_id',
        'service_provider_setting_date',
        'user_id',
        'user_setting_date',
        'notice_setting',
        'notice_user_setting',
        'line_id',
    ];
}
