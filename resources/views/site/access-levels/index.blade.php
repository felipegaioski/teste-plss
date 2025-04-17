@php
    $category_type = 'access_levels'
@endphp

@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            @include('site.access-levels.header')
            <div class="list-container">
                <div class="list-header row m-0">
                    <div class="id-container col-1">
                        <span class="m-0">ID</span>
                    </div>
                    <div class="name-container col-4">
                        <span class="m-0">Nome</span>
                    </div>
                    <div class="email-container col-2">
                        <span class="m-0">Qtd. de usuários</span>
                    </div>
                    <div class="date-container col-4">
                        <span class="m-0">Data de Criação</span>
                    </div>
                    <div class="date-container col-1">
                    </div>
                </div>
                @foreach($access_levels as $index => $access_level)
                    <div class="list-item-container row">
                        <div class="id-container col-1">
                            <span class="m-0">#{{ $access_level->id }}</span>
                        </div>
                        <div class="name-container col-4">
                            <span class="m-0">{{ $access_level->name }}</span>
                        </div>
                        <div class="email-container col-2">
                            <span class="m-0">{{ $access_level->users->count() }}</span>
                        </div>
                        <div class="date-container col-4">
                            <span class="m-0">{{ date('d/m/Y', strtotime($access_level->created_at)) }}</span>
                        </div>
                        <div class="date-container col-1">
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
                            <a href="{{ url('niveis-de-acesso/' . $access_level->id . '/editar') }}">
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                    @if ($access_levels->count() > 1 && $index < $access_levels->count() - 1)
                    <hr class="m-0">
                    @endif
                @endforeach
            </div>
        </div>
    </main>
@endsection