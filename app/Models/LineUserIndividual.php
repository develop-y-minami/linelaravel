<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LineUserIndividual
 * 
 */
class LineUserIndividual extends Model
{
    use HasFactory;
    use \App\Traits\Relations\BelongsToGender;
}
