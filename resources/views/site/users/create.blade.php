@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            <div>
                @include('site.users.header')
            </div>
            <div class="inner-container">
                <div class="form-container">
                    <form action="{{ url('/usuarios/novo') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Nome completo*</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do usuário">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">E-mail*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email do usuário">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Senha*</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Nível de Acesso*</label>
                            <select name="access_level_id" id="access_level_id" class="form-control">
                                <option value="">Selecione o nível de acesso</option>
                                @foreach ($access_levels as $access_level)
                                    <option value="{{ $access_level->id }}">{{ $access_level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection