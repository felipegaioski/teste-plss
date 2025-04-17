<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPermission extends Model
{
    use HasFactory;

    public function access_levels()
    {
        return $this->belongsToMany(AccessLevel::class)->withPivot('allow');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\UserPermissionCategory', 'user_permission_category_id');
    }

}
