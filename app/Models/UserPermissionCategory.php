<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPermissionCategory extends Model
{
    use HasFactory;

    protected $table = 'user_permission_categories';

    public function permissions()
    {
        return $this->hasMany('App\Models\UserPermission');
    }
}
