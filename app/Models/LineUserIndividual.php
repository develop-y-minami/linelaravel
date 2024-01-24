<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineUserIndividual
 * 
 * LINEユーザー個人情報
 * 
 */
class LineUserIndividual extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToGender;
}
