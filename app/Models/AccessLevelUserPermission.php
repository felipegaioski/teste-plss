<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AccessLevelUserPermission extends Pivot
{
    protected $table = 'access_level_user_permission';
    
    protected $casts = [
        'allow' => 'boolean'
    ];
}
