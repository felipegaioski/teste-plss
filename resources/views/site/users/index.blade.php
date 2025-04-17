@php
    $category_type = 'users'
@endphp

@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            @include('site.users.header')
            <div class="list-container">
                <div class="list-header row m-0">
                    <div class="id-container col-1">
                        <span class="m-0">ID</span>
                    </div>
                    <div class="name-container col-3">
                        <span class="m-0">Nome</span>
                    </div>
                    <div class="email-container col-3">
                        <span class="m-0">E-mail</span>
                    </div>
                    <div class="email-container col-2">
                        <span class="m-0">Nível de Acesso</span>
                    </div>
                    <div class="date-container col-1">
                        <span class="m-0">Data de Criação</span>
                    </div>
                    <div class="date-container col-2">
                    </div>
                </div>
                @foreach($users as $index => $_user)
                    <div class="list-item-container row">
                        <div class="id-container col-1">
                            <span class="m-0">#{{ $_user->id }}</span>
                        </div>
                        <div class="name-container col-3">
                            <span class="m-0">{{ $_user->name }}</span>
                        </div>
                        <div class="email-container col-3">
                            <span class="m-0">{{ $_user->email }}</span>
                        </div>
                        <div class="email-container col-2">
                            <span class="m-0">{{ $_user->access_level->name }}</span>
                        </div>
                        <div class="date-container col-1">
                            <span class="m-0">{{ date('d/m/Y', strtotime($_user->created_at)) }}</span>
                        </div>
                        <div class="date-container col-2 d-flex gap-2 justify-content-end">
                            @php
                                $canEdit = false;
                                foreach ($user->access_level->permissions as $permission) {
                                    if (($permission->type === 'manage' && $user->access_level->permissions->contains($permission->id) && $permission->pivot->allow
                                    && $permission->category->type == $category_type)
                                    || $user->access_level_id == 1) {
                                        $canEdit = true;
                                        break;
                                    }
                                }
                            @endphp
                            @if ($canEdit)
                            <a href="{{ url('usuarios/' . $_user->id . '/editar') }}">
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                                @if ($_user->id != $user->id)
                                <span>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $_user->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </span>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if ($users->count() > 1 && $index < $users->count() - 1)
                    <hr class="m-0">
                    @endif
                @endforeach
            </div>
        </div>
    </main>
    @if ($users->count())
        <div class="modal fade" id="deleteModal{{ $_user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o usuário <strong>{{ $_user->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger"
                            onClick="deleteUser({{ $_user->id }})">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function deleteUser(userId) {
            fetch(`/usuarios/${userId}/excluir`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    console.log('Erro ao excluir o usuário.');
                }
            }).catch(() => {
                console.log('Erro ao excluir o usuário.');
            });
        }
    </script>
@endsection