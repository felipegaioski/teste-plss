@extends('site.layout-not-logged')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center mt-5">
        <div class="login-logo my-5">
            <img src="{{ asset('assets/img/plss.png') }}" alt="Logo" width="200">
        </div>
        <div class="inner-container mt-5 d-flex flex-column">
            <div class="title d-flex justify-content-center">
                <h1>404</h1>
            </div>
            <div class="form-container d-flex justify-content-center">
                <span>Ops! Página não encontrada!</span>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button class="btn btn-primary" onclick="history.back()">Voltar</button>
            </div>
        </div>
    </div>
@endsection
