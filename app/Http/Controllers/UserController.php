<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AccessLevel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{ 
    public function get() {
        if (!$this->checkViewPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        $users = User::all();

        return view('site.users.index', compact('users'));
    }

    public function checkViewPermission() 
    {
        $user = auth()->user();
        $canView = false;
        foreach ($user->access_level->permissions as $permission) {
            if (($permission->type === 'view' && $permission->category->type === 'users' && $permission->pivot->allow)) {
                $canView = true;
                break;
            }
        }
        if (!$canView) {
            return false;
        }
        return true;
    }

    public function checkEditPermission() 
    {
        $user = auth()->user();
        $canView = false;
        foreach ($user->access_level->permissions as $permission) {
            if (($permission->type === 'manage' && $permission->category->type === 'users' && $permission->pivot->allow)) {
                $canView = true;
                break;
            }
        }
        if (!$canView) {
            return false;
        }
        return true;
    }

    public function store(Request $request) 
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        try {
            DB::beginTransaction();

            $data = $request->validate([
                'name' => ['required', 'min:3', 'max:100'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:8', 'max:20'],
                'access_level_id' => ['required'],
            ], [
                'name.required' => 'O campo nome é obrigatório.',
                'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
                'name.max' => 'O nome não pode ter mais de 100 caracteres.',
                'email.required' => 'O campo e-mail é obrigatório.',
                'email.email' => 'O campo e-mail deve ser um e-mail válido.',
                'email.unique' => 'O e-mail já está em uso.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
                'password.max' => 'A senha não pode ter mais de 20 caracteres.',
                'access_level_id.required' => 'O campo nível de acesso é obrigatório.',
            ]);

            $data['password'] = bcrypt($data['password']);

            $user = User::create($data);

            $notification = array(
                'message' => 'Salvo com Sucesso!',
                'alert-type' => 'success'
            );

            DB::commit();
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            
            $errorMessages = implode(' ', array_map(function ($message) {
                return implode(', ', $message);
            }, $errors));
    
            return redirect('/usuarios/novo')->with([
                'message' => $errorMessages,
                'alert-type' => 'warning'
            ]);
        }
        catch (\Exception $e) {
            DB::rollBack();
        
            info('Erro ao salvar usuário: ' . $e->getMessage(), ['exception' => $e]);
        
            return redirect('/usuarios/novo')->with([
                'message' => 'Ocorreu um erro ao salvar o usuário.',
                'alert-type' => 'warning'
            ]);
        }

        return redirect('/usuarios')->with($notification);
    }

    public function edit($id) 
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        $_user = User::find($id);
        $access_levels = AccessLevel::all();
        if (is_null($_user)) {
            return redirect('/usuarios');
        }
        return view('site.users.edit', compact('_user', 'access_levels'));
    }

    public function update(Request $request, $id) 
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }
        
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'name' => ['required', 'min:3', 'max:100'],
                'access_level_id' => ['required'],
            ], [
                'name.required' => 'O campo nome é obrigatório.',
                'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
                'name.max' => 'O nome não pode ter mais de 100 caracteres.',
                'access_level_id.required' => 'O campo nível de acesso é obrigatório.',
            ]);

            $user = User::findOrFail($id);

            $user->update($data);

            $notification = array(
                'message' => 'Atualizado com Sucesso!',
                'alert-type' => 'success'
            );

            DB::commit();
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            
            $errorMessages = implode(' ', array_map(function ($message) {
                return implode(', ', $message);
            }, $errors));
    
            return redirect('/usuarios/' . $id . '/editar')->with([
                'message' => $errorMessages,
                'alert-type' => 'warning'
            ]);
        }
        catch (\Exception $e) {
            DB::rollBack();
        
            info('Erro ao atualizar usuário: ' . $e->getMessage(), ['exception' => $e]);
        
            return redirect('/usuarios/' . $id . '/editar')->with([
                'message' => 'Ocorreu um erro ao atualizar o usuário.',
                'alert-type' => 'warning'
            ]);
        }

        return redirect('/usuarios')->with($notification);
    }

    public function destroy($id)
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->delete();

            $notification = array(
                'message' => 'Deletado com Sucesso!',
                'alert-type' => 'success'
            );

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            info('Erro ao deletar usuário: ' . $e->getMessage(), ['exception' => $e]);
            return redirect('/usuarios')->with([
                'message' => 'Ocorreu um erro ao deletar o usuário.',
                'alert-type' => 'warning'
            ]);
        }
        
        return redirect('/usuarios')->with($notification);
    }

    public function login(Request $request) 
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return back()->with([
                'message' => 'Usuário não encontrado.',
                'alert-type' => 'error',
            ]);
        }
    }

    public function loginPage()
    {
        return view('site.users.login');
    }

    public function createPage()
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        $access_levels = AccessLevel::all();
        return view('site.users.create', compact('access_levels'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
