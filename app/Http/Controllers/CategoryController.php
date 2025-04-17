<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get() 
    {
        if (!$this->checkViewPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        return view('site.categories.index');
    }

    public function checkViewPermission() 
    {
        $user = auth()->user();
        $canView = false;
        foreach ($user->access_level->permissions as $permission) {
            if (($permission->type === 'view' && $permission->category->type === 'categories' && $permission->pivot->allow)) {
                $canView = true;
                break;
            }
        }
        if (!$canView) {
            return false;
        }
        return true;
    }
}
