<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineUser
 * 
 * LINEユーザー情報
 * 
 */
class LineUser extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToPersonality;
    use \App\Traits\Relations\BelongsToPrefecture;
    use \App\Traits\Relations\HasOneLineUserCorporate;
    use \App\Traits\Relations\HasOneLineUserIndividual;
}
