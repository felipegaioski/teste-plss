@php
    $category_type = 'tickets';
@endphp

@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            @include('site.tickets.header')
            <ul class="nav nav-tabs mb-3">
                @php
                    $currentStatus = request()->query('status');
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ is_null($currentStatus) ? 'active' : '' }}"
                        href="{{ route('tickets.index') }}">Todos</a>
                </li>
                @foreach ($statuses as $status)
                    <li class="nav-item">
                        <a class="nav-link {{ $currentStatus === $status->slug ? 'active' : '' }}"
                            href="{{ route('tickets.index', ['status' => $status->slug]) }}">{{ $status->name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="list-container">
                <div class="list-header row m-0">
                    <div class="col-1">
                        <span class="m-0">ID</span>
                    </div>
                    <div class="col-2">
                        <span class="m-0">Título</span>
                    </div>
                    <div class="col-2">
                        <span class="m-0">Categoria</span>
                    </div>
                    <div class="col-1">
                        <span class="m-0">Situação</span>
                    </div>
                    <div class="col-2">
                        <span class="m-0">Data de criação</span>
                    </div>
                    <div class="col-2">
                        <span class="m-0">Data limite</span>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                @foreach ($tickets as $index => $ticket)
                    <div class="list-item-container row">
                        <div class="col-1">
                            <span class="m-0">#{{ $ticket->id }}</span>
                        </div>
                        <div class="col-2">
                            <span class="m-0 fw-bold">{{ $ticket->title }}</span>
                        </div>
                        <div class="col-2">
                            <span class="m-0">{{ $ticket->category->name }}</span>
                        </div>
                        <div class="col-1 text-center">
                            <div class="badge
                            {{ $ticket->status_id == 1 ? 'bg-primary' : ($ticket->status_id == 2 ? 'bg-warning' : 'bg-success') }}">
                                <span class="m-0">{{ $ticket->status->name }}</span>
                            </div>
                        </div>
                        <div class="col-2">
                            <span class="m-0">{{ date('d/m/Y', strtotime($ticket->created_at)) }}</span>
                        </div>
                        <div class="col-2">
                            @if ($ticket->status_id != 3)
                                <span class="m-0 
                                {{ $ticket->deadline > now()->endOfDay() ? 'text-success' : ($ticket->deadline < now()->startOfDay() ? 'text-danger fw-bold' : 'text-warning') }}">
                                    {{ date('d/m/Y', strtotime($ticket->deadline)) }}
                                </span>
                            @else
                                <span class="m-0">
                                    {{ date('d/m/Y', strtotime($ticket->deadline)) }}
                                </span>
                                <div class="badge
                                    {{ ($ticket->solved_at && $ticket->solved_at > $ticket->deadline ? 'bg-warning' : 'bg-success') }}">
                                    <span class="m-0">Finalizado em {{  date('d/m/Y', strtotime($ticket->solved_at)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-2 d-flex gap-2 justify-content-end">
                            @php
                                $canEdit = false;
                                foreach ($user->access_level->permissions as $permission) {
                                    if (
                                        ($permission->type === 'manage' &&
                                            $user->access_level->permissions->contains($permission->id) &&
                                            $permission->pivot->allow &&
                                            $permission->category->type == $category_type) ||
                                        $user->access_level_id == 1
                                    ) {
                                        $canEdit = true;
                                        break;
                                    }
                                }

                                $canSolve = false;
                                if ($user->access_level_id == 1) {
                                    $canSolve = true;
                                }
                            @endphp
                            @if ($canSolve)
                                @if ($ticket->status_id == 1)
                                    <form action="{{ url('chamados/' . $ticket->id . '/iniciar') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-primary">
                                            Iniciar
                                        </button>
                                    </form>
                                @endif
                                @if ($ticket->status_id == 2)
                                    <form action="{{ url('chamados/' . $ticket->id . '/finalizar') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-primary">
                                            Finalizar
                                        </button>
                                    </form>
                                @endif
                                <span>
                                    <button class="btn btn-primary" onclick="toggleDescription({{ $ticket->id }})">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </span>
                            @endif
                            @if ($canEdit)
                                <a href="{{ url('chamados/' . $ticket->id . '/editar') }}">
                                    <button class="btn btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                                <span>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $ticket->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row ticket-description p-2" id="description-{{ $ticket->id }}" style="display: none;">
                        <p>Descrição: {{ $ticket->description ? $ticket->description : 'Sem descrição' }}</p>
                    </div>
                    @if ($tickets->count() > 1 && $index < $tickets->count() - 1)
                        <hr class="m-0">
                    @endif
                @endforeach
                @if ($tickets->count() == 0)
                <div class="d-flex justify-content-center text-center p-2 text-secondary">
                    <span>Nenhum chamado encontrado</span>
                </div>
                @endif
            </div>
        </div>
    </main>
    @if ($tickets->count())
        <div class="modal fade" id="deleteModal{{ $ticket->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o chamado?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger"
                            onClick="deleteTicket({{ $ticket->id }})">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function toggleDescription(ticketId) {
            const descDiv = document.getElementById('description-' + ticketId);
            if (descDiv.style.display === 'none' || descDiv.style.display === '') {
                descDiv.style.display = 'block';
            } else {
                descDiv.style.display = 'none';
            }
        }

        function deleteTicket(ticketId) {
            fetch(`/chamados/${ticketId}/excluir`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    console.log('Erro ao excluir o chamado.');
                }
            }).catch(() => {
                console.log('Erro ao excluir o chamado.');
            });
        }
    </script>
@endsection
