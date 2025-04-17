@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            <div>
                @include('site.access-levels.header')
            </div>
            <div class="inner-container">
                <div class="form-container">
                    <form action="{{ url('/niveis-de-acesso/novo') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do nível de acesso">
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