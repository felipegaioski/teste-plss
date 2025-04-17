<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    // public function get(Request $request) {
    //     if (!$this->checkViewPermission()) {
    //         return redirect()->back()->with([
    //             'message' => 'Você não tem permissão para acessar essa página.',
    //             'alert-type' => 'error'
    //         ]);
    //     }

    //     $status = $request->query('status');

    //     $tickets = Ticket::with(['category', 'status']);

    //     if ($status) {
    //         $tickets->whereHas('status', function ($query) use ($status) {
    //             $query->where('slug', $status);
    //         });
    //     }    

    //     $tickets = $tickets->get();

    //     return view('site.tickets.index', compact('tickets'));
    // }

    public function index(Request $request) {
        if (!$this->checkViewPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        $status = $request->query('status');

        $tickets = Ticket::with(['category', 'status']);

        if ($status) {
            $tickets->whereHas('status', function ($query) use ($status) {
                $query->where('slug', $status);
            });
        }    

        $tickets = $tickets->orderBy('deadline', 'asc')->get();

        $statuses = Status::all();

        return view('site.tickets.index', compact('tickets', 'statuses'));
    }

    public function checkViewPermission() 
    {
        $user = auth()->user();
        $canView = false;
        foreach ($user->access_level->permissions as $permission) {
            if (($permission->type === 'view' && $permission->category->type === 'tickets' && $permission->pivot->allow)) {
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
            if (($permission->type === 'manage' && $permission->category->type === 'tickets' && $permission->pivot->allow)) {
                $canView = true;
                break;
            }
        }
        if (!$canView) {
            return false;
        }
        return true;
    }

    public function createPage()
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        $categories = Category::all();
        return view('site.tickets.create', compact('categories'));
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
                'title' => ['required', 'min:1', 'max:255'],
                'category_id' => ['required'],
                'description' => ['nullable'],
            ], [
                'title.required' => 'O campo "Título" é obrigatório.',
                'title.min' => 'O Título deve ter pelo menos 1 caracter.',
                'title.max' => 'O Título não pode ter mais de 255 caracteres.',
                'category_id.required' => 'O campo "Categoria" é obrigatório.',
            ]);

            $data['deadline'] = now()->addDays(3);
            $data['status_id'] = 1; // Novo

            $ticket = Ticket::create($data);

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
    
            return redirect('/chamados/novo')->with([
                'message' => $errorMessages,
                'alert-type' => 'warning'
            ]);
        }
        catch (\Exception $e) {
            DB::rollBack();
        
            info('Erro ao salvar chamado: ' . $e->getMessage(), ['exception' => $e]);
        
            return redirect('/chamados/novo')->with([
                'message' => 'Ocorreu um erro ao salvar o chamado.',
                'alert-type' => 'warning'
            ]);
        }

        return redirect('/chamados')->with($notification);
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

            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            $notification = array(
                'message' => 'Deletado com Sucesso!',
                'alert-type' => 'success'
            );

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            info('Erro ao deletar chamado: ' . $e->getMessage(), ['exception' => $e]);
            return redirect('/usuarios')->with([
                'message' => 'Ocorreu um erro ao deletar o chamado.',
                'alert-type' => 'warning'
            ]);
        }
        
        return redirect('/chamados')->with($notification);
    }

    public function start($id)
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        try {
            DB::beginTransaction();

            $ticket = Ticket::findOrFail($id);
            $ticket->update(['status_id' => 2]);

            $notification = array(
                'message' => 'Chamado iniciado!',
                'alert-type' => 'success'
            );

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
        
            info('Erro ao iniciar chamado: ' . $e->getMessage(), ['exception' => $e]);
        
            return redirect('/chamados')->with([
                'message' => 'Ocorreu um erro ao iniciar o chamado.',
                'alert-type' => 'warning'
            ]);
        }

        return redirect('/chamados')->with($notification);
    }

    public function finish($id)
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        try {
            DB::beginTransaction();

            $ticket = Ticket::findOrFail($id);

            $data = [
                'status_id' => 3,
                'solved_at' => now(),
            ];

            $ticket->update($data);

            $notification = array(
                'message' => 'Chamado finalizado!',
                'alert-type' => 'success'
            );

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
        
            info('Erro ao finalizar chamado: ' . $e->getMessage(), ['exception' => $e]);
        
            return redirect('/chamados')->with([
                'message' => 'Ocorreu um erro ao finalizar o chamado.',
                'alert-type' => 'warning'
            ]);
        }

        return redirect('/chamados')->with($notification);
    }

    public function edit($id) 
    {
        if (!$this->checkEditPermission()) {
            return redirect()->back()->with([
                'message' => 'Você não tem permissão para acessar essa página.',
                'alert-type' => 'error'
            ]);
        }

        $ticket = Ticket::find($id);

        $categories = Category::all();

        info($ticket->get());

        if (is_null($ticket)) {
            return redirect('/chamados');
        }
        return view('site.tickets.edit', compact('ticket', 'categories'));
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
                'title' => ['required', 'min:1', 'max:255'],
                'category_id' => ['required'],
                'description' => ['nullable'],
            ], [
                'title.required' => 'O campo "Título" é obrigatório.',
                'title.min' => 'O Título deve ter pelo menos 1 caracter.',
                'title.max' => 'O Título não pode ter mais de 255 caracteres.',
                'category_id.required' => 'O campo "Categoria" é obrigatório.',
            ]);

            $ticket = Ticket::findOrFail($id);

            $ticket->update($data);

            $notification = array(
                'message' => 'Atualizado com Sucesso!',
                'alert-type' => 'success'
            );

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
        
            info('Erro ao atualizar chamado: ' . $e->getMessage(), ['exception' => $e]);
        
            return redirect('/chamados/' . $id . '/editar')->with([
                'message' => 'Ocorreu um erro ao atualizar o chamado.',
                'alert-type' => 'warning'
            ]);
        }

        return redirect('/chamados')->with($notification);
    }
}
