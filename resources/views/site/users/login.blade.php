@extends('site.layout-not-logged')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center mt-5">
        <div class="login-logo my-5">
            <img src="{{ asset('assets/img/plss.png') }}" alt="Logo" width="200">
        </div>
        <div class="inner-container mt-2 flex-column">
            <div class="title d-flex justify-content-center">
                <h1>Login</h1>
            </div>
            <div class="form-container">
                <form action="{{ url('/usuarios/login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email do usuário">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha">
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
